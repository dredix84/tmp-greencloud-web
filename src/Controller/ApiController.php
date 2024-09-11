<?php

namespace App\Controller;

use App\Controller\AppController;

namespace App\Controller;
use App\Model\Entity\Merchant;
use App\Model\Entity\Receipt;
use App\Service\CurrencyConverter;
use App\Service\LogHandler;
use Cake\Core\Configure;

/**
 * Description of Api
 *
 * @author Andre
 */
class ApiController extends AppController {

    private $merchant;
    private $toSerialize = ['authorized', 'msg'];

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();

        $this->loadModel('Merchants');
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);

        $this->set('_serialize', $this->toSerialize);
    }

    private function getUserPass() {
        $username = $this->request->getData('user');
        $password = $this->request->getData('pass');

        if (null === $username || null === $password) {
            $this->set('authorized', 0);
            $this->set('msg', __('No API credentials received.'));
            $this->set('_serialize', ['authorized', 'msg']);
            $this->render('blank');
            return ['user' => '', 'pass' => ''];
        } else {
            return [
                'user' => $this->request->getData('user'),
                'pass' => $this->request->getData('pass')
            ];
        }
    }

    /**
     * Used to determine is the current request should be authorized to get data
     * @return type
     */
    public function authorized() {
        $creds = $this->getUserPass();
        $this->merchant = $this->Merchants->checkAccess($creds['user'], $creds['pass']);
        //die(json_encode([$this->merchant, $creds]));
        $this->set('authorized', $this->merchant->authorized);
        $this->set('msg', $this->merchant->msg);
        return $this->merchant->authorized;
    }

    /**
     * Used to get Merchant data
     */
    public function getMechantInfo() {
        if ($this->authorized() == 1) {

            $this->set('merchant', $this->merchant);
            $this->toSerialize[] = 'merchant';
        }
        $this->render('blank');
    }

    public function desktopStartInfo(){
        if ($this->authorized() == 1) {
            $this->loadModel('Receipts');
            $remainingCredits = $this->Receipts->getCreditsRemaining($this->merchant->id);
            $imageUrl = WEBROOT . Configure::read("logo_medium");
            $dHeader = "<center><img style=\"max-width:150px\" src='$imageUrl' /></center><br /><br />";
            $dFooter = Configure::read('desktop_footer');

            $this->set('remainingCredits', $remainingCredits);
            $this->set('nowDate', date('Y-m-d'));
            $this->set('merchant', $this->merchant);
            $this->set('header', $dHeader);
            $this->set('footer', $dFooter);
            $this->toSerialize[] = 'remainingCredits';
            $this->toSerialize[] = 'nowDate';
            $this->toSerialize[] = 'merchant';
            $this->toSerialize[] = 'header';
            $this->toSerialize[] = 'footer';
        }
        $this->render('blank');
    }

    /**
     * Used to save the receipt is version 1.1 and earlier.
     * @param string $filename the name the file should be saved as
     */
    public function txnfile($filename) {
        $this->loadModel('Receipts');
        $result = $this->Receipts->saveReceiptFromRequest($filename);
        /*if (count($_FILES) > 0) {
            $target_dir = \Cake\Core\Configure::read('receipts_file_path');
            $target_file = $target_dir . $filename . '.pdf';
            $uploadOk = 1;
            $FileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $msg = "";

            if ($FileType != "pdf") {
                $msg = "Sorry, only PDF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    $msg = "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                }
            }
        } else {
            $msg = "No file found.";
            $uploadOk = 0;
        }*/
        $this->set('authorized', $result->uploadOk);
        $this->set('file_uploaded', $result->uploadOk);
        $this->set('msg', __($result->msg));
        $this->render('blank');
    }

    /**
     * Used to process (save) a transaction data
     */
    function postTransaction() {
    	$requestId = $this->generateRandomString(5, date('Y-m-d'));
        LogHandler::info(sprintf('%s: New postTransaction request received.' , $requestId),  ['requestId'=>$requestId]);

        $sendCustomerData = true;
        if ($this->request->getData('customer_phone') === null && $this->request->getData('customer_email') === null) {
            $this->set('authorized', 0);
            $this->set('msg', __('No customer identification data submitted.'));
            $sendCustomerData = false;
            LogHandler::warning(
                'No customer identification data submitted',
                ['requestId' => $requestId, 'requestData' => $this->request->getData()]
            );
            return $this->render('blank');
        }
        if ($this->authorized() == 1 && $sendCustomerData) {

            $this->loadModel('Users');
            $this->loadModel('Receipts');

            $customerConditions = [];
            if ($this->request->getData('customer_phone') === null) {
                $customerConditions['phone'] = $this->request->getData('customer_phone');
            } elseif ($this->request->getData('customer_email') !== null) {
                $customerConditions['email'] = $this->request->getData('customer_email');
            }

            $user = $this->Users->getTranactionUser($this->request->getData());  //Get the used info and creates an accont if none exist

			/** @var Merchant $m */
			$m = &$this->merchant;

			/** @var Receipt $r */
            $r = $this->Receipts->newEntity();
            $r->merchant_id = $m->id;
            $r->user_id = $user->id;
            $r->ip_address = $this->__get_client_ip();
            $request_data = $this->request->getData();
            unset($request_data['receipt_text_data']);
            unset($request_data['receipt_html_unsigned']);
            unset($request_data['receipt_html_signed']);
            unset($request_data['raw_request_data']);
            $r->request_data = json_encode($request_data);

            $r->security_key = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);
            if($m->has('loyalty_program')){
                $r->loyalty_cost = $m->loyalty_program->cost_per_receipt;
                $r->loyalty_percentage = $m->loyalty_program->percentage_per_receipt;
                $r->loyalty_points = $m->loyalty_program->point_per_receipt;
                $r->points_cost_ratio = $m->loyalty_program->points_cost_ratio;
            }else{
				$this->log(sprintf('%s: No loyalty Program data for merchant "%s".' , $requestId, $m->id), 'debug', ['requestId'=>$requestId]);
            }
            if($m->has('payment_structure') ){
                $currencyHandler = new CurrencyConverter(
                    Configure::read('currency.api_key'),
                    $m->payment_structure->currency,
                    $m->currency
                );

                $r->merchant_receipt_cost = $m->payment_structure->cost_per_receipt;
                $r->credits_used = $currencyHandler->convert($m->payment_structure->cost_per_receipt);
            }else{
				$this->log(sprintf('%s: No payment_structure data for merchant "%s".' , $requestId, $m->id), 'debug', ['requestId'=>$requestId]);
            }

            $input_names = [
                'provider_id', 'terminal', 'receipt_number', 'claim_number', 'policy_number', 'receipt_date', 'discount_type', 'discount_type',
                'discount', 'subtotal', 'tax', 'total', 'payment_type_id', 'note', 'receipt_text_data', 'should_email', 'send_sms',
                'payment_type_id', 'authorize_number', 'coverage_paid', 'balance', 'doctor', 'is_test', 'refund', 'reprint', 'refund_amount'
            ];
            $input_defaults = [
                'receipt_number' => 'receipt_' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10),
                'receipt_date' => date('Y-m-d '),
                'should_email' => Configure::read('should_email_default'),
                'send_sms' => Configure::read('should_sms_default'),
                'payment_type_id' => Configure::read('payment_type_id_default'),
                'is_test' => 0,
                'refund' => 0,
                'reprint' => 0
            ];
            $rData = array();
            foreach ($input_names as $iname) {
                if ( isset($request_data[$iname]) &&  !empty($request_data[$iname])) {
                    $r->{$iname} = trim($request_data[$iname]);
                } elseif (array_key_exists($iname, $input_defaults)) {
                    $r->{$iname} = trim($input_defaults[$iname]);
                }
            }
            if ($this->request->getData('receipt_text_data') !== null) {
                $r->receipt_text_data = base64_decode($this->request->getData('receipt_text_data'));
            }

            $r->saved = $this->Receipts->save($r) ? true : false;

            if($r->saved){
				$this->log(sprintf('%s: Receipt data saved. Receipt ID "%s".' , $requestId, $r->id), 'debug', ['requestId'=>$requestId]);
                if(isset($request_data['appversion']) && $request_data['appversion'] == '1.2'){     //Receipt pdf is sent with verison 1.2
                    $this->Receipts->saveReceiptFromRequest($r->id);
                }
				$this->set('msg', __('Receipt was successfully saved.'));
                if ($r->should_email) {
                    $this->Receipts->sendCustomerEmailNotification($r->id);
                    LogHandler::debug("Sending email for receipt " . $r->id,  ['requestId'=>$requestId]);
                }

                if ($r->send_sms ) {
                    $this->loadModel('SmsLogs');
                    $this->SmsLogs->sendReceiptSms($r, $m, $user);
                    LogHandler::debug("Sending SMS for receipt " . $r->id,  ['requestId'=>$requestId]);
                }
            }else{
				$this->log(sprintf('%s: Receipt data was not saved.' , $requestId), 'error', [
					'requestId'=>$requestId,
					'receipt' => $r
				]);
				$this->set('msg', __('There was an issue saving the receipt.'));
			}

            $this->set('success', $r->saved);

            //$this->set('user', $user);
            $this->set('receipt', $r);
            $this->toSerialize[] = 'success';
            $this->toSerialize[] = 'save_message';
            //$this->toSerialize[] = 'user';
            $this->toSerialize[] = 'receipt';
            //die(pr($this->toSerialize));
        }else{
            $message = 'Transaction was rejected because account was locked or inactive';
            $this->set('msg', $message);
            $this->log($message . ' Request data: ' . json_encode($_REQUEST), 'info');
        }
        $this->render('blank');
    }


}
