<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Receipts Controller
 *
 * @property \App\Model\Table\ReceiptsTable $Receipts
 */
class ReceiptsController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        if ($this->userinfo['role_id'] == 1) {
            $conditions = ['user_id' => $this->userinfo['id']];
        } elseif ($this->userinfo['role_id'] == 2) {
            $conditions = ['Receipts.merchant_id' => $this->userinfo['merchant_id']];
        } elseif ($this->userinfo['role_id'] == 3) {
            $conditions = ['Receipts.provider_id' => $this->userinfo['provider_id']];
        } else {
            $conditions = array();
        }

        $receipt = $this->Receipts->newEntity();
        if (isset($_REQUEST['a'])) {
            $this->request->data = array_filter($_REQUEST);
            $receipt = $this->Receipts->patchEntity($receipt, $this->request->data);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = ['receipt_number', 'user_note', 'claim_number', 'terminal', 'policy_number', 'authorize_number', 'receipt_text_data'];
                if (count($orFields) == 0) {
                    $this->Flash->error('Receipts has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Receipts index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Receipts.' . $orFields[$i] . ' LIKE'] = "%$term%";
                }
            }
            $allowedSeacrhField = [
                'claim_number' => '~',
                'policy_number' => '~',
                'receipt_number' => '~',
                'authorize_number' => '~',
                'total' => '=',
                'Receipts.provider_id' => '=',
                'Receipts.merchant_id' => '=',
                'receipt_date' => 'date'
            ];


            $rData = [];
            foreach ($r as $nowR => $nowRVal) {
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
        $this->paginate = [
            'contain' => ['Merchants', 'Providers', 'Users', 'PaymentTypes']
        ];
        $this->set('receipt', $receipt);
        if($this->Permission->hasPermission('receipts.viewallmerchants')){
            $this->set('merchants', $this->Receipts->Merchants->find('list', ['order' => ['Merchants.name' => 'ASC']]));
        }else{
            $this->set('merchants', $this->Receipts->Merchants->customerMerchants($this->userinfo['id']));
        }
        
        $this->set('providers', $this->Receipts->Providers->find('list', ['order' => ['Providers.name' => 'ASC']]));
        $this->set('receipts', $this->paginate($this->Receipts->find('all', ['conditions' => $conditions, 'order' => ['Receipts.id' => 'DESC']])));

        $this->Receipts->markedSeen($this->userinfo['id']); //Marking receipts are seen

        $this->set('_serialize', ['receipts', 'receipt', 'merchants']);
    }

    /**
     * View method
     *
     * @param string|null $id Receipt id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $receipt = $this->Receipts->get($id, [
            'contain' => ['Merchants', 'Providers', 'Users', 'PaymentTypes', 'ReceiptItems']
        ]);
        //Ensure the user should have access to this receipt
        if (!($receipt->user_id == $this->userinfo['id'] || $receipt->merchant_id == $this->userinfo['merchant_id'] || $receipt->provider_id == $this->userinfo['provider_id'])) {
            if (!$this->Permission->isAdmin()) {
                throw new \Cake\Network\Exception\UnauthorizedException(__('You are not authorized to view this receipt.'));
            }
        }

        if ($this->userinfo['role_id'] == 1 && $receipt->user_id != $this->userinfo['id']) {
            throw new NotFoundException(__('Receipt does not belong to you.'));
        }
        $this->set('receipt', $receipt);
        $this->set('_serialize', ['receipt']);
    }

    public function previewReceipt($id, $skey, $download = FALSE) {
        $skey = str_replace('.pdf', '', $skey);
        $file = \Cake\Core\Configure::read('receipts_file_path') . $id . '.pdf';
        $receipt = $this->Receipts->get($id, [
            'contain' => []
        ]);
        if ($receipt->security_key != $skey) {
            throw new \Cake\Network\Exception\UnauthorizedException(__('You are not authorized to view this receipt.'));
        }

        //Ensure the user should have access to this receipt
        if (!($receipt->user_id == $this->userinfo['id'] || $receipt->merchant_id == $this->userinfo['merchant_id'] || $receipt->provider_id == $this->userinfo['provider_id'])) {
            if (!$this->Permission->isAdmin()) {
                throw new \Cake\Network\Exception\UnauthorizedException(__('You are not authorized to view this receipt.'));
            }
        }

        if (file_exists($file)) {

            header("Content-Length: " . filesize($file));
            if ($download) {
                header("Content-type: application/octet-stream");
                header("Content-disposition: attachment; filename=" . basename($file));
            } else {
                header("Content-type: application/pdf");
                header("Content-disposition: inline; filename=" . basename($file));
            }
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            ob_clean();
            flush();

            readfile($file);
            die;
        } else {
            die("Unable to find $file.");
        }
    }

    /*
      public function add()
      {
      $receipt = $this->Receipts->newEntity();
      if ($this->request->is('post')) {
      $receipt = $this->Receipts->patchEntity($receipt, $this->request->data);
      if ($this->Receipts->save($receipt)) {
      $this->Flash->success(__('The receipt has been saved.'));
      if(!empty($this->request->data['return_url'])){
      if($this->request->data['return_url'] == 'true'){
      return $this->redirect($_SERVER['HTTP_REFERER']);
      }else{
      return $this->redirect($this->request->data['return_url']);
      }
      }else{
      return $this->redirect(['action' => 'index']);
      }
      } else {
      $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
      }
      }
      $merchants = $this->Receipts->Merchants->find('list', ['limit' => 200]);
      $providers = $this->Receipts->Providers->find('list', ['limit' => 200]);
      $users = $this->Receipts->Users->find('list', ['limit' => 200]);
      $paymentTypes = $this->Receipts->PaymentTypes->find('list', ['limit' => 200]);
      $this->set(compact('receipt', 'merchants', 'providers', 'users', 'paymentTypes'));
      $this->set('_serialize', ['receipt']);

      //$this->render('addedit');
      }


      public function edit($id = null)
      {
      $receipt = $this->Receipts->get($id, [
      'contain' => []
      ]);
      if ($this->request->is(['patch', 'post', 'put'])) {
      $receipt = $this->Receipts->patchEntity($receipt, $this->request->data);
      if ($this->Receipts->save($receipt)) {
      $this->Flash->success(__('The receipt has been saved.'));
      if(!empty($this->request->data['return_url'])){
      if($this->request->data['return_url'] == 'true'){
      return $this->redirect($_SERVER['HTTP_REFERER']);
      }else{
      return $this->redirect($this->request->data['return_url']);
      }
      }else{
      return $this->redirect(['action' => 'index']);
      }
      } else {
      $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
      }
      }
      $merchants = $this->Receipts->Merchants->find('list', ['limit' => 200]);
      $providers = $this->Receipts->Providers->find('list', ['limit' => 200]);
      $users = $this->Receipts->Users->find('list', ['limit' => 200]);
      $paymentTypes = $this->Receipts->PaymentTypes->find('list', ['limit' => 200]);
      $this->set(compact('receipt', 'merchants', 'providers', 'users', 'paymentTypes'));
      $this->set('_serialize', ['receipt']);

      //$this->render('addedit');
      }

      public function delete($id = null)
      {
      $this->request->allowMethod(['post', 'delete']);
      $receipt = $this->Receipts->get($id);
      if ($this->Receipts->delete($receipt)) {
      //$this->Flash->success(__('The receipt has been deleted.'));
      } else {
      throw new NotFoundException(__('Unable to delete record.'));
      //$this->Flash->error(__('The receipt could not be deleted. Please, try again.'));
      }
      return $this->redirect(['action' => 'index']);
      } */
    
    public function adminmailtest($id){
        if($this->Permission->isAdmin()){
            die(pr($this->Receipts->sendCustomerEmailNotification($id)));
        }
    }
}
