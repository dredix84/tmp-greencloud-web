<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Mailer\Email;
use \Cake\Core\Configure;
use Cake\Network\Exception\UnauthorizedException;
use Cake\I18n\Time;

/**
 * AutoActions Controller
 *
 * @property \App\Model\Table\AutoActionsTable $AutoActions
 */
class AutoActionsController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        
        $localIPs = Configure::read('local_ips');
        if(in_array($this->request->clientIp(), $localIPs) || ($this->Permission->isAdmin())){
            $this->Auth->allow();
        }else{
            $this->log($this->request->clientIp() . " tried to access AutoActions.      URL: " . $_SERVER['REDIRECT_URL'] . "       DATA: " . json_encode($_REQUEST, JSON_PRETTY_PRINT), 'critical');
            throw new UnauthorizedException('not allowed');
        }
        
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->Permission->controllerPermission($this->request);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {

        $conditions = array();
        if (isset($_REQUEST['a'])) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = [];
                if (count($orFields) == 0) {
                    $this->Flash->error('AutoActions has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] AutoActions index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['AutoActions.' . $orFields[$i] . ' LIKE'] = "%$term%";
                }
            }
            $allowedSeacrhField = [];   //Example: ['title' => '~', 'total' => '=','user.city' => '=', 'receipt_date' => 'date']

            $rData = [];
            foreach ($r as $nowR => $nowRVal) {   //Preparing data to be in "Table.field" format if array is found
                if (is_array($nowRVal)) {
                    foreach ($nowRVal as $k => $v) {
                        $rData["$nowR.$k"] = $v;
                    }
                } else {
                    $rData[$nowR] = $nowRVal;
                }
            }
            if (count($allowedSeacrhField) > 0) {
                foreach ($rData as $nowR => $nowRVal) {
                    if (is_array($nowRVal)) {
                        $k = key($nowRVal);
                        $nowR .= '.' . $k;
                        $nowRVal = $nowRVal[$k];
                    }
                    if (in_array($nowR, array_keys($allowedSeacrhField)) && !empty($nowRVal)) {
                        if ($allowedSeacrhField[$nowR] == '~') {
                            $conditions["$nowR LIKE "] = "%" . trim($nowRVal) . "%";
                        } elseif ($allowedSeacrhField[$nowR] == 'date') {
                            $conditions["DATE_FORMAT($nowR,'%Y-%m-%d')"] = trim($nowRVal);
                        } else {
                            $conditions[$nowR] = trim($nowRVal);
                        }
                    }
                }
            }
        }
        $this->set('autoActions', $this->paginate($this->AutoActions->find('all', ['conditions' => $conditions, 'order' => 'AutoActions.id DESC'])));
        $this->set('_serialize', ['autoActions']);
    }

    /**
     * View method
     *
     * @param string|null $id Auto Action id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $autoAction = $this->AutoActions->get($id, [
            'contain' => []
        ]);
        $this->set('autoAction', $autoAction);
        $this->set('_serialize', ['autoAction']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $autoAction = $this->AutoActions->newEntity();
        if ($this->request->is('post')) {
            $autoAction = $this->AutoActions->patchEntity($autoAction, $this->request->data);
            if ($this->AutoActions->save($autoAction)) {
                $this->Flash->success(__('The auto action has been saved.'));
                if (!empty($this->request->data['return_url'])) {
                    if ($this->request->data['return_url'] == 'true') {
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        return $this->redirect($this->request->data['return_url']);
                    }
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The auto action could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('autoAction'));
        $this->set('_serialize', ['autoAction']);

        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Auto Action id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $autoAction = $this->AutoActions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $autoAction = $this->AutoActions->patchEntity($autoAction, $this->request->data);
            if ($this->AutoActions->save($autoAction)) {
                $this->Flash->success(__('The auto action has been saved.'));
                if (!empty($this->request->data['return_url'])) {
                    if ($this->request->data['return_url'] == 'true') {
                        return $this->redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        return $this->redirect($this->request->data['return_url']);
                    }
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The auto action could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('autoAction'));
        $this->set('_serialize', ['autoAction']);

        //$this->render('addedit');
    }

    public function merchantsMarkLowBalance() {
        set_time_limit(0);      //Setting execution time to unlimited
        $this->loadModel('merchant_info');
        $this->loadModel('merchants');
        $now = Time::now();
        $dataField = array();
        $merchants = $this->merchant_info->find('all')
                ->where([
                    'merchant_info.is_active' => 1,
                    'merchant_info.is_locked' => 0,
                    'merchant_info.deleted' => 0,
                    'merchant_info.low_credit_mail_sent_date IS NULL',
                    '(merchant_info.credits_purchased - merchant_info.credits_used) <= merchant_info.low_credit_alert_amount'
                ])
                ->contain(['CreatedByUser']);
        $autoAction = $this->AutoActions->newEntity();
        $autoAction->row_count = $merchants->count();
        $autoAction->title = 'Mailing Low Credits - ' . $now->nice();
        $autoAction->action_type = 'Mailing Low Credits';
        $autoAction->note = "";

        echo $autoAction->row_count . " merchant accounts to process for low balance email.\n";
        if ($autoAction->row_count > 0) {
            //die(pr($m->created_by_user));
            $sentIDs = [];
            $failIDs = [];
            $expireDate = Time::now()->addDay(Configure::read('over_creddits_expire_days'));

            foreach ($merchants as $m) {
                $remainingCredits = $m->credits_purchased - $m->credits_used;
                $mailStatus = null;
                $email = new Email(Configure::read('emailprofile'));
                $email->template('lowcredits', 'default')
                        ->emailFormat('both')
                        ->to($m->contact_email)
                        //->addCc($failIDs)
                        ->subject(__('Green Cloud Credit Low - ' . $now->toDateString()))
                        ->from(Configure::read('emailfrom'))
                        ->viewVars([
                            'merchant' => $m,
                            'expireDate' => $expireDate,
                            'remainingCredits' => $remainingCredits
                ]);
                if ($m->created_by_user->email != $m->contact_email) {
                    $email->addBcc($m->created_by_user->email);
                }
                if ($email->send()) {
                    $sentIDs[] = $m->id;
                    echo "Email sent to " . $m->contact_email . " with remaining credit of $remainingCredits \n";
                    $mailStatus = true;
                } else {
                    $failIDs[] = $m->id;
                    $mailStatus = false;
                }
                $dataField[] = [
                    'id' => $m->id,
                    'name' => $m->name,
                    'receipt_count' => $m->receipt_count,
                    'credits_used' => $m->credits_used,
                    'credits_purchased' => $m->credits_purchased,
                    'remaining_credits' => $remainingCredits,
                    'expiry_date' => $expireDate,
                    'contact_name' => $m->contact_name,
                    'contact_email' => $m->contact_email,
                    'user_email' => $m->created_by_user->email,
                    'mail_sent' => $mailStatus
                ];
            }
            $autoAction->note = "Emails sent: " . count($sentIDs) . "\nEmails failed: " . count($failIDs);
            
            $this->merchants->updateAll(
                    ['low_credit_mail_sent_date' => $now], // fields
                    ['id IN (' . implode(',', $sentIDs) . ')']// conditions
            );
        } else {
            $autoAction->note = 'No accounts to email';
        }
        
        $autoAction->data = json_encode($dataField, JSON_PRETTY_PRINT);
        if ($this->AutoActions->save($autoAction)) {
            echo "Data saved\n";
        } else {
            echo "Data not saved\n";
        }
        
        die('Green Cloud Credit Low - ' . $now->nice() . " \n" . $autoAction->note);
    }

}
