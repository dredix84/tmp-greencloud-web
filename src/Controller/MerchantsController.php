<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Service\Address;
use App\Service\SlackHandler;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Psr\Log\LogLevel;

/**
 * Merchants Controller
 *
 * @property \App\Model\Table\MerchantsTable $Merchants
 */
class MerchantsController extends AppController
{

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
    }

    /**
     * Used to determine if the use has permission to edit the merchant account
     * @param type $merchant
     * @throws ForbiddenException
     */
    private function __allowEdit($merchant)
    {
        if (!($merchant->id == $this->userinfo['merchant_id'] || $merchant->created_by == $this->userinfo['id'] || $this->Permission->isAdmin())) {
            throw new ForbiddenException(__('You dont have permission to perform the action for this merchant account.'));
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        if (!$this->Permission->isAdmin()) {    // && $this->userinfo['role_id'] == 2
            return $this->redirect(['action' => 'myAccounts']);
        }

        $this->Permission->controllerPermission($this->request);
        $conditions = [];
        if (isset($_REQUEST['a'])) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term     = trim($r['search_term']);
                $orFields = ['name', 'code', 'contact_name', 'contact_phone', 'username', 'city'];
                if (count($orFields) == 0) {
                    $this->Flash->error('Merchants has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Merchants index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Merchants.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
                        $k       = key($nowRVal);
                        $nowR    .= '.' . $k;
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
            'contain' => ['Industries', 'PaymentStructures', 'LoyaltyPrograms']
        ];
        $this->set('merchants', $this->paginate($this->Merchants->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['merchants']);
    }

    public function myAccounts()
    {
        $this->Permission->controllerPermission($this->request);
        $conditions[0] = [
            'OR' => [
                'Merchants.id'         => $this->userinfo['merchant_id'],
                'Merchants.created_by' => $this->userinfo['id']
            ]
        ];
        if (isset($_REQUEST['a'])) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term     = trim($r['search_term']);
                $orFields = ['name', 'code', 'contact_name', 'contact_phone', 'username', 'city'];
                if (count($orFields) == 0) {
                    $this->Flash->error('Merchants has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] Merchants index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions[1]["OR"]['Merchants.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
                        $k       = key($nowRVal);
                        $nowR    .= '.' . $k;
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
            'contain' => ['Industries', 'PaymentStructures', 'LoyaltyPrograms']
        ];
        $this->set('merchants', $this->paginate($this->Merchants->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['merchants']);
    }

    /**
     * View method
     *
     * @param string|null $id Merchant id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Permission->controllerPermission($this->request);
        $merchant = $this->Merchants->get($id, [
            'contain' => ['Industries', 'PaymentStructures', 'LoyaltyPrograms', 'Activeusers', 'Credits', 'Locations', 'MerchantUsers', 'Payments', 'Users']
        ]);
        $this->__allowEdit($merchant);  //Checking if the user has permission
        if ($this->Permission->isAdmin()) {
            $this->loadModel('Receipts');
            $remainingCredits = $this->Receipts->getCreditsRemaining($id) * -1; //Todo: Change this when updating the code to reflect balance
            $this->set(compact('remainingCredits'));
        }
        $this->set('merchant', $merchant);
        $this->set('_serialize', ['merchant']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //@TODO: Check to ensure the is no attemtp to tamper with the form and introduce restricted fields
        $merchant = $this->Merchants->newEntity();
        if ($this->request->is('post')) {
            $merchant                       = $this->Merchants->patchEntity($merchant, $this->request->data);
            $merchant->username             = $this->getNewUid();
            $merchant->password             = $this->getNewUid();
            $merchant->payment_structure_id = Configure::read('default_payment_structure');
            $merchant->loyalty_program_id   = Configure::read('default_loyalty_program');

            if ($this->Merchants->save($merchant)) {
                $merchant = $this->Merchants->get($merchant->id, [
                    'contain' => ['Industries']
                ]);

                try {
                    SlackHandler::newMerchantNotification($merchant);
                } catch (\Exception $e) {
                    $this->log('There was an error while attempting to send a slack notification when creating a new merchant account. Error: ' . $e->getMessage(),
                        LogLevel::ERROR,
                        [
                            'error' => $e->getMessage(),
                            'file'  => $e->getFile(),
                            'line'  => $e->getLine(),
                        ]
                    );
                }

                $this->loadModel('Users');
                $this->loadModel('Credits');
                $user = $this->Users->get($this->userinfo['id'], [
                    'contain' => ['Roles', 'Merchants']
                ]);
                if (empty($user->merchant_id) || $user->merchant_id == -1) {  //This merchant is not being assign to this user
                    $user->merchant_id = $merchant->id;
                    $this->Users->save($user);
                    $user = $this->Users->get($this->userinfo['id'], [
                        'contain' => ['Roles', 'Merchants']
                    ]);
                    $this->Auth->setUser($user->toArray());
                }
                $this->Flash->success(__('Your merchant account has been created.'));

                //Adding free credits
                $freeCredits = Configure::read('merchant_free_credits');
                if ($freeCredits > 0) {
                    if ($this->Credits->addCredits($merchant->id, null, $freeCredits, __('Free signup credits'), $user->id)) {
                        $this->Flash->default(__("Your merchant account has been given $freeCredits free credits. These credits will allow you to try out the system risk. Enjoy!!"));
                    }
                }

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
                $this->Flash->error(__('The merchant could not be saved. Please, try again.'));
            }
        }

        $address           = new Address($this->request->clientIp());
        $industries        = $this->Merchants->Industries->find('list', ['limit' => 200]);
        $paymentStructures = $this->Merchants->PaymentStructures->find('list', ['limit' => 200]);
        $countries         = $this->Merchants->Countries->find('list', ['limit' => 500]);
        $loyaltyPrograms   = $this->Merchants->LoyaltyPrograms->find('list', ['limit' => 200]);
        $this->set(compact('merchant', 'industries', 'paymentStructures', 'loyaltyPrograms', 'countries', 'address'));
        $this->set('_serialize', ['merchant']);
    }

    /**
     * Used by the administrator to edit the merchant account
     * @return type
     */
    public function admin_add()
    {
        $this->Permission->controllerPermission($this->request);
        $merchant = $this->Merchants->newEntity();
        if ($this->request->is('post')) {
            $merchant = $this->Merchants->patchEntity($merchant, $this->request->data);
            if ($this->Merchants->save($merchant)) {
                $this->Flash->success(__('The merchant has been saved.'));
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
                $this->Flash->error(__('The merchant could not be saved. Please, try again.'));
            }
        }
        $industries        = $this->Merchants->Industries->find('list', ['limit' => 200]);
        $paymentStructures = $this->Merchants->PaymentStructures->find('list', ['limit' => 200]);
        $loyaltyPrograms   = $this->Merchants->LoyaltyPrograms->find('list', ['limit' => 200]);
        $this->set(compact('merchant', 'industries', 'paymentStructures', 'loyaltyPrograms'));
        $this->set('_serialize', ['merchant']);

        //$this->render('addedit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Merchant id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //@TODO: Check to ensure the is no attemtp to tamper with the form and introduce restricted fields
        $merchant = $this->Merchants->get($id, [
            'contain' => []
        ]);
        $this->__allowEdit($merchant);  //Checking if the user has permission
        if ($this->request->is(['patch', 'post', 'put'])) {
            $merchant = $this->Merchants->patchEntity($merchant, $this->request->data);
            if ($this->Merchants->save($merchant)) {
                $this->Flash->success(__('The merchant has been updated'));
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
                $this->Flash->error(__('The merchant could not be saved. Please, try again.'));
            }
        }

        $address           = new Address($this->request->clientIp());
        $industries        = $this->Merchants->Industries->find('list', ['limit' => 200]);
        $paymentStructures = $this->Merchants->PaymentStructures->find('list', ['limit' => 200]);
        $loyaltyPrograms   = $this->Merchants->LoyaltyPrograms->find('list', ['limit' => 200]);
        $countries         = $this->Merchants->Countries->find('list', ['limit' => 500]);
        $this->set(compact('merchant', 'industries', 'paymentStructures', 'loyaltyPrograms', 'countries', 'address'));
        $this->set('_serialize', ['merchant']);

        $this->render('add');
    }

    /**
     * Used to change the password used for the merchant account
     * @param type $id The ID  of the merchant account the changes should be made to
     * @return type
     */
    public function resetApiPassword($id)
    {
        $merchant = $this->Merchants->get($id);
        $this->__allowEdit($merchant);  //Checking if the user has permission

        $merchant->password = $this->getNewUid();
        $this->Merchants->save($merchant);
        $user             = $this->userinfo;
        $user['merchant'] = $merchant->toArray();
        $this->Auth->setUser($user);
        $this->Flash->success(__('Your merchant account API password has been changed.'));
        return $this->redirect(['controller' => 'dashboards', 'action' => 'index']);
    }

    public function switchTo($id)
    {
        $merchant = $this->Merchants->get($id);
        $this->__allowEdit($merchant);  //Checking if the user has permission
        $this->userinfo['merchant_id'] = $id;
        $this->userinfo['merchant']    = $merchant->toArray();

        $this->Auth->setUser($this->userinfo);
        $this->Flash->success(__('You have switched to the following merchant account: ') . $merchant->name . ' - ' . $merchant->city);
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Allow the user to deactivate a merchant account
     * @param type $id Merchant ID
     */
    public function deactivate($id)
    {
        $merchant = $this->Merchants->get($id);
        $this->__allowEdit($merchant);  //Checking if the user has permission
        $merchant->deleted         = 1;
        $merchant->is_active       = 0;
        $merchant->deactivate_note = __('Deactivated by user.');
        $merchant->date_deleted    = \Cake\I18n\Time::now();
        $merchant->deleted_by      = $this->userinfo['id'];

        if ($this->Merchants->save($merchant)) {
            $this->Flash->default(__('Your account has need deactivated: ') . $merchant->name . ' - ' . $merchant->city);
        } else {
            $this->Flash->error(__('There was an error while attempting to deactivate the account: ') . $merchant->name . ' - ' . $merchant->city);
        }
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function changeActivationStatus($id)
    {
        $merchant = $this->Merchants->get($id, [
            'contain' => ['Industries', 'PaymentStructures', 'LoyaltyPrograms', 'Activeusers', 'Credits', 'Locations', 'MerchantUsers', 'Payments', 'Receipts', 'Users', 'CratedByUser']
        ]);
        $this->__allowEdit($merchant);  //Checking if the user has permission
        if (isset($this->request->data['new_status'])) {
            $d                    = &$this->request->data;
            $merchant->is_active  = $d['new_status'];
            $merchant->is_locked  = !$merchant->is_active;
            $merchant->admin_note = $d['admin_note'];
            if ($this->Merchants->save($merchant)) {
                $this->Flash->success(__('The merchant account is ') . ($merchant->is_active ? 'actived' : 'deactived'));
                if ($d['send_email'] == 1) {
                    $email = new Email(Configure::read('emailprofile'));
                    $email->template('default_html', 'default')
                        ->emailFormat('html')
                        ->to($d['email_to'])
                        ->subject($d['subject'])
                        ->from(Configure::read('emailfrom'))
                        ->viewVars(['content' => $d['message']]);
                    if ($email->send()) {
                        $this->Flash->success(__('Email send to merchant.'));
                    } else {
                        $this->Flash->error(__('Error while attempting to send email to merchant.'));
                    }
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('There was an issue while attempting to make changed to the merchant account.'));
            }
        }

        $this->set('merchant', $merchant);
        $this->set('_serialize', ['merchant']);
    }
}
