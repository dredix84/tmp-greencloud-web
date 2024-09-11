<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Mailer\Email;
use Cake\I18n\Time;
use \Cake\Core\Configure;

/**
 * Used to do maintenance related task for GreenCloud
 *
 * @author Andre
 */
class MaintenanceShell extends Shell {

    public function main() {
        $this->out('Hello world.');
    }

    public function fixNullMedecus() {
        $now = \Cake\I18n\Time::now();
        $this->out('Executing Fix Null Medecus Receipts.');
        $this->out('Execution date: ' . $now->nice(), true);

        $this->loadModel('Receipts');
        $this->loadModel('AutoActions');
        $autoAction = $this->AutoActions->newEntity();

        $data = $this->Receipts->fixNullMedecus();
        if (count($data['affectedRows']) == 0) {
            $autoAction->note = 'Not receipts found which need fixing.';
            $this->out($autoAction->note);
        } else {
            $autoAction->note = 'Affected count: ' . count($data['affectedRows']);
            $this->out($autoAction->note);
            $this->out('Affected receipt IDs: ' . implode(', ', $data['affectedRows']));
        }

        $autoAction->row_count = count($data['affectedRows']);
        $autoAction->title = 'Fix Null Medecus Receipts - ' . $now->nice();
        $autoAction->action_type = 'Fix Null Medecus';
        $autoAction->data = json_encode($data['affectedRows'], JSON_PRETTY_PRINT);
        $this->AutoActions->save($autoAction);
    }

    /**
     * Used to deactivate merchant account which have in negative and where send warning emails
     */
    public function setAccountToExpired() {
        $this->loadModel('MerchantInfo');
        $this->loadModel('Merchants');
        $this->loadModel('AutoActions');
        $autoNote = "";
        $autoData = [];
        $now = Time::now();

        $this->out('Processing started: ' . $now->nice());
        define('WEBROOT', Configure::read('webroot'));
        $toExpire = $this->MerchantInfo->find('all')
                ->where([
                    'MerchantInfo.is_active' => 1,
                    'MerchantInfo.test_account' => 0,
                    'now() > DATE_ADD(MerchantInfo.low_credit_mail_sent_date, INTERVAL 7 DAY)',
                    'MerchantInfo.credits_used > MerchantInfo.credits_purchased'
                ])
                ->contain(['CreatedByUser']);
        $row_count = $toExpire->count();
        $this->out('Total account to process: ' . $row_count);
        foreach ($toExpire as $m) {
            $autoData[$m->id] = [];
            $outTitle = $m->name . ' (ID: ' . $m->id . ')';
            $autoNote .= "$outTitle\n";
            $this->out('Now processing: ' . $outTitle);

            $merchant = $this->Merchants->get($m->id);
            $merchant->is_active = 0;
            $merchant->deactivate_note = "\nScript deactivated account for negative balance on " . $now->nice();
            if ($this->Merchants->save($merchant)) {
                $autoData[$m->id]['deactivated'] = true;
                $this->out('Account deactivated');
                $names = [$m->contact_name];
                if ($m->contact_name != $m->created_by_user->first_name & ' ' & $m->created_by_user->last_name) {
                    $names[] = $m->created_by_user->first_name & ' ' & $m->created_by_user->last_name;
                }
                $email = new Email(Configure::read('emailprofile'));
                $email->template('lowcredits_deactivted', 'default')
                        ->emailFormat('html')
                        ->to($m->contact_email)
                        //->addCc($failIDs)
                        ->subject(__('Green Cloud Merchant Account Deactivated - ') . $now->toDateString())
                        ->from(Configure::read('emailfrom'))
                        ->viewVars([
                            'merchant' => $m,
                            'names' => $names
                ]);
                if ($m->created_by_user->email != $m->contact_email) {
                    $email->addBcc($m->created_by_user->email);
                }
                if ($email->send()) {
                    $autoData[$m->id]['emailed'] = TRUE;
                    $this->out('Email sent.');
                } else {
                    $autoData[$m->id]['emailed'] = false;
                    $this->out('Unable to send email.');
                    $this->log('Account deactivated but there was an issue while attempting to send deactivation email. Record ID: ' . $m->id);
                }
            } else {
                $autoData[$m->id]['deactivated'] = false;
                $autoData[$m->id]['emailed'] = false;
                $this->out('Unable to deactivate merchant account (unable to save).');
                $this->log('Unable to deactivate merchant account as script was Maintenance - setAccountToExpired script was unable to update database record. Record ID: ' . $m->id);
            }
            $this->out('Processing for ' . $outTitle . ' is complete.', 2);
        }
        $this->AutoActions->addRecord(
                'Deactivate merchants - ' . $now->nice(), 
                'Deactivate Merchants', 
                $row_count, 
                $autoNote,
                json_encode($autoData, JSON_PRETTY_PRINT));
        $this->out('Processing finished: ' . $now->nice());
    }

}
