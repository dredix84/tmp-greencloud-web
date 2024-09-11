<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Controller\Component\RequestHandlerComponent;
use Cake\Database\Type;
use Cake\Routing\Router;
use \Ceeram\Blame\Controller\BlameTrait;

Type::build('date')->setLocaleFormat('yyyy-MM-dd');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    use BlameTrait;

    protected $userinfo = array();

    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        //$this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->loadComponent('Flash');
        $this->loadComponent('Permission');

		if (!defined('WEBROOT')) {
			define('WEBROOT', Router::url('/', true));
		}

        $this->loadComponent('Auth', [
            'authError' => __('You need to login before you can access that area or feature.'),
            'loginRedirect' => [
                'controller' => 'Dashboards',
                'action' => 'index'
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'Login'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'Login'
            ],
                /* 'storage' => 'Memory',
                  'unauthorizedRedirect' => false */
        ]);

        /* $this->loadComponent('Auth', [
          'authenticate' => [
          'Basic' => [
          //'fields' => ['username' => 'username', 'password' => 'api_key'],
          'userModel' => 'Apiusers'
          ],
          ],
          'storage' => 'Memory',
          'unauthorizedRedirect' => false
          ]); */
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        //$this->Security->requireSecure();
        $this->Auth->config('authenticate', [
            'Basic' => ['userModel' => 'Apiusers'],
            'Form' => [
                'userModel' => 'Users',
                'finder' => 'auth'
            ]
        ]);
        if ($this->Auth->user()) {
            $this->userinfo = $this->Auth->user();
            //if($this->Permission->isAdmin()){ Configure::write('debug', true); }    //Enable debug if admin
        }


        //If user is an admin
        if ($this->Permission->isAdmin() && !$this->request->session()->check('is_admin')) {
            if ($this->Permission->isAdmin()) {
                $this->request->session()->write('is_admin', true);
                $this->loadModel('Users');
                $roles = $this->Users->getRoleIds();
                $this->request->session()->write('user.roles', $roles);
            } else {
                $this->request->session()->write('is_admin', false);
            }
        }

        if (!$this->request->is('ajax')) {
            $this->viewBuilder()->layout('porto');
        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        if ($this->request->param('controller') != 'Api') {
            $this->set('navmenu', $this->getMenu());
        }

        if ($this->Auth->user()) {  //Checks if user is logged in
            $this->set('userinfo', $this->Auth->user());
            if ($this->userinfo['role_id'] == 2) {   //@TODO: Refactor to use session or CACHE to reduce load on database
                $this->set('merchantAccounts', $this->__getMechantList($this->userinfo['id']));
            }
        }

        if (isset($_REQUEST['f'])) {
            $f = &$_REQUEST['f'];
            if ($f == 'json') {
                $this->RequestHandler->renderAs($this, 'json');
                $this->response->type('application/json');
                $this->set('_serialize', true);
            } elseif ($f == 'xml') {
                $this->RequestHandler->renderAs($this, 'xml');
                $this->response->type('application/xml');
                $this->set('_serialize', true);
            }
        }
    }

    /**
     * Used to generate a new UID
     * @param String $userStr Any string that should be used to generate the new UID
     * @return String The newly generate UID
     */
    protected function getNewUid($userStr = null) {
        if ($userStr == null) {
            //return uniqid() . uniqid();
            return sha1(mt_rand(10000, 99999) . time() . date('Y-m-d') . mt_rand(10000, 99999));
        } else {
            return sha1(mt_rand(10000, 99999) . time() . $userStr . mt_rand(10000, 99999));
        }
    }

    protected function sendmail($to, $subject, $message) {
        $email = new Email(Configure::read('emailprofile'));
        $email->from(Configure::read('emailfrom'))
                ->emailFormat('html')
                ->to($to)
                ->subject($subject);
        return $email->send($message);
    }

    protected function getMenu() {
        $this->loadModel('ParentMenus');
        $menus = $this->ParentMenus->find('all', [
            'contain' => ['Menus'],
            'conditions' => [
                'ParentMenus.is_active' => 1,
                'OR' => [['ParentMenus.role_id' => $this->Auth->user()['role_id']], ['ParentMenus.role_id IS NULL']],
            //'Menus.is_active' => 1
            ],
            'order' => ['ParentMenus.sort_order' => 'ASC']
        ]);
        return $menus;
    }

    // replace any non-ascii character with its hex code.
    function escape($value) {
        $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
        $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $value);
    }

    protected function __get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     * Used to log where in the application a use has attempted to access. The details can be found in the user_activity table.
     * @param type $title   Title on the activity if any
     * @param type $note    A note to attach to the activity if any
     * @param type $risk    1 if this should be considered a risk
     * @param type $flag    A int flag to help filter
     */
    public function logActivity($title = null, $note = null, $risk = 0, $flag = 0) {
        $this->loadModel('UserActivities');
        $activity = $this->UserActivities->newEntity();
        $activity->title = $title;
        $activity->note = $note;
        $activity->risk = $risk;
        $activity->flag = $flag;
        $activity->user_id = $this->Permission->getUserId();
        $activity->controller = $this->request->param('controller');
        $activity->action = $this->request->param('action');
        $activity->ip_address = $this->__get_client_ip();
        $otherData = [
            '_ext' => $this->request->param('_ext'),
            'pass' => $this->request->param('pass'),
            'isAjax' => $this->request->param('isAjax'),
            'data' => $this->request->data,
            'query' => $this->request->query,
        ];
        $activity->other_data = json_encode($otherData);

        try {
            $this->UserActivities->save($activity);
        } catch (Exception $ex) {
            
        }
    }

    private function __getMechantList($merchant_id) {
        $this->loadModel('Merchants');
        $merchantAccounts = $this->Merchants->find('all', [
            'fields' => ['id', 'name', 'city', 'contact_name'],
            'conditions' => [
                'Merchants.is_active' => 1,
                'Merchants.deleted' => 0,
                'OR' => ['created_by' => $merchant_id]
            ]
        ]);
        return $merchantAccounts;
    }

    /**
     * Used by callback to force SSL. See URL below fo details
     * http://securityblog.gr/1963/cakephp-3-force-all-actions-to-require-ssl/
     * @return type
     */
    public function forceSSL() {
        return $this->redirect('https://' . env('SERVER_NAME') . $this->request->here);
    }

	/**
	 * Used to generate a random string;
	 * @param int $length
	 * @return string
	 */
	function generateRandomString($length = 10, $prefix = '') {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $prefix . $randomString;
	}
}
