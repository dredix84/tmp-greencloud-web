<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Service\Address;
use Cake\Mailer\Email;
use \Cake\Core\Configure;
use Cake\Network\Exception\UnauthorizedException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['registermerchant', 'registeruser', 'signup', 'resetPassword', 'doactivate', 'sendActivtionEmail']);
    }

    public function index() {
        if(!$this->Permission->hasPermission('users.index')){
            return $this->redirect(['controller' => 'Dashboards']);
        }
        
        $this->logActivity();
        $this->loadModel('Roles');
        //$this->Permission->requirePermission('users.index');

        $conditions = [];
        if (isset($_REQUEST['a'])) {
            //$this->request->data = array_filter($_REQUEST);   //Unable to account for 0 values when this function is used
            $this->request->data = $_REQUEST;
            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = ['username', 'first_name', 'last_name', 'phone', 'email', 'city'];
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['Users.' . $orFields[$i] . ' LIKE'] = "%$term%";
                }
            }

            $allowedSeacrhField = [
                'role_id' => '=',
                'user_registered' => '='
            ];   //Example: ['title' => '~', 'total' => '=','user.city' => '=', 'receipt_date' => 'date']

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
                    if (in_array($nowR, array_keys($allowedSeacrhField)) && $nowRVal != null) {
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
            'contain' => ['Merchants', 'Roles']
        ];

        $roles = $this->Users->Roles->find('list', ['limit' => 200, 'order' => ['Roles.title' => 'ASC']]);
        $this->set(compact('roles'));
        $this->set('users', $this->paginate($this->Users->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->Permission->requirePermission('users.view');
        $this->Permission->controllerPermission($this->request);
        $user = $this->Users->get($id, [
            'contain' => ['Merchants', 'Roles', 'Countries', 'MerchantAccounts']
        ]);
        if($user->role_id == 1){
            $receiptCnt = $this->Users->Receipts->getReceiptCount($user->id);
            $customerLoyalty = $this->Users->Receipts->getCustomerLoyalty($user->id);
            $this->set(compact('receiptCnt', 'customerLoyalty'));
        }
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function signup() {
        
    }

    public function registermerchant() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->getUserByPhoneOrEmail($this->request->data['phone'], $this->request->data['email']);
            if (!empty($user)) {
                if ($user->user_registered == 1) {   //User already registered
                    $this->Flash->success(__('There is an account already registered with that email or phone number. Please login instead. If you dont remember your password, use the Password Reset.'));
                    return $this->redirect(['controller' => 'users', 'action' => 'index']);
                }
            }

            $this->request->data['merchant_id'] = -1;
            $this->request->data['role_id'] = 2;
            $this->request->data['user_registered'] = 1;
            $this->request->data['register_date'] = date('Y-m-d');
            $this->request->data['activation_code'] = $this->getNewUid($this->request->data['email']);  //Generating random

			//die(pr($this->request->data));
			$user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your account has been created.'));
                $this->sendactivationmail($user->id);
                $this->Flash->success(__('Please check your email for instructions on how to activate your account.'));
                return $this->redirect(['controller' => 'Dashboards', 'action' => 'index']);
            } else {
                $this->Flash->error(__('There was an issue while attempting to create your account.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function registeruser() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            
            $existUser = $this->Users->getUserByPhoneOrEmail($this->request->data['phone'], $this->request->data['email']);

            $this->request->data['role_id'] = 1;
            $this->request->data['user_registered'] = 1;
            $this->request->data['register_date'] = date('Y-m-d');
            $this->request->data['activation_code'] = $this->getNewUid($this->request->data['email']);  //Generating random 

            if (!empty($existUser)) {
                if ($existUser->user_registered == 1) {   //User already registered
                    $this->Flash->success(__('There is an account already registered with that email or phone number. Please login instead. If you dont remember your password, use the Password Reset.'));
                    return $this->redirect(['controller' => 'users', 'action' => 'index']);
                }
                $this->Flash->success(__('We see that you have at least one receipt so linked those receipt(s) to your account.'));
                $user = $this->Users->patchEntity($existUser, $this->request->data);
            }

            $user = $this->Users->patchEntity($user, $this->request->data);
            if(!isset($this->request->data['agreeterms'])){
                $this->Flash->error(__('You have not agreed to the terms and conditions of this service.'));
            }elseif ($this->Users->save($user)) {
                $this->Flash->success(__('Your account has been created.'));
                $this->sendactivationmail($user->id);
                $this->Flash->success(__('Please check your email for instructions on how to activate your account.'));
                return $this->redirect(['controller' => 'users', 'action' => 'index']);
            } else {
                $this->Flash->error(__('There was an issue while attempting to create your account.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function login() {
        if ($this->Permission->isLoggedIn()) {
            return $this->redirect(['controller' => 'dashboards', 'action' => 'index']);
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['activated'] != 1) {
                    $this->Flash->error(__('Your account has not been activated. Please check your email for instructions on how to activate your account.'));
                } elseif ($user['is_locked'] == 1) {
                    $this->Flash->error(__('Your account been locked. Please contact an admin regarding this lock status.'));
                } elseif ($user['is_active'] != 1) {
                    $this->Flash->error(__('Your account is not currently active'));
                } else {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error(__('Invalid username or password, try again'));
            }
            $this->set('user_', $user);
        }
    }

    public function logout() {
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function resetPassword($useremail = null, $useract = null) {
        if ($this->request->is(['post'])) {
            $user = $this->Users->findByEmail($this->request->data['email'])->first();
            if (!empty($user)) {
                $activation_code = $this->getNewUid($this->request->data['email']);  //Generating random 
                $user->activation_code = $activation_code;
                $this->Users->save($user);

                $aurl = WEBROOT . "users/reset-password/" . $user->email . "/" . $activation_code;

                $email = new Email(Configure::read('emailprofile'));
                $email->template('resetpassword_step1', 'default')
                        ->emailFormat('both')
                        ->to($user->email)
                        ->subject(__('Reset Password'))
                        ->from(Configure::read('emailfrom'))
                        ->viewVars(['aurl' => $aurl, 'name' => $user->first_name]);
                $email->send();
            }
            $this->Flash->set(_('If the email address is valid, an email will be sent to you with instructions on how to reset your account password.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        } elseif ($useremail != null && $useract != null) {
            $user = $this->Users->findByEmail($useremail)->first();
            if (!empty($user)) {
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!#_-.";
                $newPassword = substr(str_shuffle($chars), 0, 8);
                $user->password = $newPassword;
                $user->activation_code = $this->getNewUid($useremail . $newPassword);  //Generating random 
                $this->Users->save($user);
                $email = new Email(Configure::read('emailprofile'));
                $email->template('resetpassword_step2', 'default')
                        ->emailFormat('both')
                        ->to($user->email)
                        ->subject(__('Reset Password'))
                        ->from(Configure::read('emailfrom'))
                        ->viewVars(['name' => $user->first_name, 'password' => $newPassword]);
                $email->send();
            }
            $this->Flash->set(_('If the email address is valid, an email will be sent with the new password.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
    }

    public function sendActivtionEmail() {
        if ($this->request->is(['post'])) {
            $user = $this->Users->findByEmail($this->request->data['email'])->first();
            if (!empty($user)) {
                $this->sendactivationmail($user->id);
            }
            $this->Flash->set(_('If your email address is valid, an email will be sent to you with instructions on how to activate your account.'));
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->Permission->controllerPermission($this->request);
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $numberExist = $this->Users->numberExist($id, $this->request->data['phone']);
            if (!empty($numberExist)) {
                $this->Flash->error(__('The telephone number entered already belong to ') . $numberExist['first_name'] . ' (User ID: ' . $numberExist['id'] . ')');
            } else {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
        }
        $merchants = $this->Users->Merchants->find('list', ['limit' => 200]);
        $providers = $this->Users->Providers->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'merchants', 'providers', 'countries'));
        $this->set('_serialize', ['user']);
    }

    public function doactivate($email = null, $actcode = null) {
        if ($email == null || $actcode == null) {
            $this->Flash->error(__('The activation link is invalid.'));
        } else {
            $alluser = $this->Users->find('all', [
                'conditions' => [
                    'email' => $email,
                    'activation_code' => $actcode
                ]
            ]);
            $user = $alluser->first();
            if (empty($user)) {
                $this->Flash->error(__('The email and activation code combination is invalid.'));
            } else {
                $user->activated = 1;
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Your account has been activated and you may now attempt to login.'));
                } else {
                    $this->Flash->error(__('There was an issue while attemmpting to activate your account.'));
                }
            }
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
    }

    private function sendactivationmail($userid) {
        $user = $this->Users->get($userid, ['contains' => []]);

        $activation_code = $this->getNewUid($this->request->data['email']);  //Generating random 
        $user->activation_code = $activation_code;
        $this->Users->save($user);

        $aurl = WEBROOT . "users/doactivate/" . $user->email . "/" . $activation_code;

        $email = new Email(Configure::read('emailprofile'));
        $email->template('activate', 'default')
                ->emailFormat('both')
                ->to($user->email)
                ->subject('Account Activation')
                ->from(Configure::read('emailfrom'))
                ->viewVars(['aurl' => $aurl, 'name' => $user->first_name]);
        return $email->send();
    }

    public function myProfile() {
        $user = $this->Users->get($this->userinfo['id'], [
            'contain' => ['Merchants', 'Providers', 'Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            //Removing data which the user should not be able to edit
            $toRemove = ['username', 'activation_code', 'role_id', 'merchant_id', 'provider_id'];
            foreach ($toRemove as $tr) {
                unset($this->request->data[$tr]);
            }
            $numberExist = $this->Users->numberExist($this->userinfo['id'], $this->request->data['phone']);
            if (!empty($numberExist)) {
                $this->Flash->error(__('The telephone number entered already already belongs to another account.'));
            } else {
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Auth->setUser($user->toArray());
                    $this->Flash->success(__('Your account profile has been updated.'));
                    return $this->redirect(['action' => 'myProfile']);
                } else {
                    $this->Flash->error(__('There was an issue while attempting to updated your account. Please, try again.'));
                }
            }
        }
        if ($this->userinfo['role_id'] == 1) {
            $receipts = $this->Users->Receipts->getReceiptCount($this->userinfo['id']);
            $this->set('receiptCount', $receipts);
        }

		$address = new Address($this->request->clientIp());

        $merchants = $this->Users->Merchants->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 500]);
        $this->set(compact('user', 'merchants', 'countries', 'address'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Used to switch user to a different role. Will throw exceiption is use is not permitted to perform action
     * @throws UnauthorizedException
     */
    public function switchrole($role_id) {
        if ($this->request->session()->read('is_admin')) {
            $this->loadModel('Roles');
            $newRole = $this->Roles->get($role_id, ['contains' => []]);
            $this->request->session()->write('Auth.User.role_id', $role_id);
            $this->request->session()->write('Auth.User.role', $newRole);

            $this->Flash->success(__('Your role has been switched to ') . __($newRole['title']) . '.');
            return $this->redirect($this->request->referer());
            //return $this->redirect(['controller' => 'Dashboards', 'action' => 'index']);
        } else {
            throw new UnauthorizedException(__('You dont have the permission required to perform this action.'));
        }
    }

    public function changeMyPassword() {
        $user = $this->Users->get($this->userinfo['id']);
        if (isset($this->request->data['current_password'])) {
            $d = &$this->request->data;
            if (\Cake\Auth\DefaultPasswordHasher::check($d['current_password'], $user->password)) {
                if ($d['new_password'] != $d['confirm_new_password']) {
                    $this->Flash->error(__('The new password and confirm passwird does not match'));
                } elseif (strlen($d['new_password']) < 6) {
                    $this->Flash->error(__('The new password you entered is too short'));
                } else {
                    $user->password = $d['new_password'];
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Your password has been updated.'));
                        return $this->redirect(['controller' => 'Dashboards', 'action' => 'index']);
                    } else {
                        $this->Flash->error(__('There was an issue while attempting to update your password. Please try again'));
                    }
                }
            } else {
                $this->Flash->error(__('This current password you entered does not match your existing password'));
            }
        }
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function __test($userid) {
        if ($this->Permission->isAdmin()) {
            die(pr($this->sendactivationmail($userid)));
        } else {
            $this->Permission->requirePermission('ljfhdkjh');
        }
    }
    
    public function merchantSwitchProfile($switchKey) {
        if(empty($this->userinfo['merchant_id'])){
            throw new UnauthorizedException(__('You dont have the permission required to perform this action.'));
        }
        
        $this->loadModel('Merchants');
        $this->loadModel('Roles');
        $newRole = $this->Roles->findBySwitchkey($switchKey)->first();
        if(empty($newRole) || !in_array($newRole->id, Configure::read('allowed_mechant_roles'))){   //Checking if use has permission and role exist
            throw new UnauthorizedException(__('You dont have the permission required to perform this action.'));
        }
        
        $this->request->session()->write('Auth.User.role_id', $newRole->id);
        $this->request->session()->write('Auth.User.role', $newRole);

        $this->Flash->success(__('You have swtiched view. You are now viewing as: ') . $newRole->title );
        return $this->redirect($this->request->referer());
    }
}
