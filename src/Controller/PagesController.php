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

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->layout('eco');
    }

    public function index()
    {
        //die('dredix');
        $this->render('index');
    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    /* public function display() {
      $path = func_get_args();

      $count = count($path);
      if (!$count) {
      return $this->redirect('/');
      }
      $page = $subpage = null;

      if (!empty($path[0])) {
      $page = $path[0];
      }
      if (!empty($path[1])) {
      $subpage = $path[1];
      }
      $this->set(compact('page', 'subpage'));

      try {
      $this->render(implode('/', $path));
      } catch (MissingTemplateException $e) {
      if (Configure::read('debug')) {
      throw $e;
      }
      throw new NotFoundException();
      }
      } */

    public function termsOfUse()
    {
        $this->set('h1', __('Terms of Use'));
    }

    public function privacyPolicy()
    {
        $this->set('h1', __('Privacy Policy'));
    }

    public function about()
    {
        $this->set('h1', __('About Green Cloud'));
    }

    public function contact()
    {
        if ($this->request->is('post')) {

            if (isset($_REQUEST['formname'])) {
                $formname = $_REQUEST['formname'];
                $contact_name = $_REQUEST['contact_name'];
                $contact_email = $_REQUEST['contact_email'];
                $contact_url = $_REQUEST['contact_url'];
                $contact_subject = $_REQUEST['contact_subject'];
                $contact_message = $_REQUEST['contact_message'];
                $datetime = date('M d, Y  @ H:i');
                $message = "From: $contact_name
Email: $contact_email
Website: $contact_url
Subject: $contact_subject
Message Date: $datetime

Message: -----------------------------
$contact_message
                        ";

                $email = new Email(Configure::read('emailprofile'));
                $email->template('default', 'default')
                    //->emailFormat('html')
                    ->to('neilb4u@gmail.com')      //@TODO: Use email from a config file for contact form
                    ->cc('dredix84@gmail.com')
                    ->subject('GreenCloud Contact Query - ' . $contact_subject)
                    ->from(Configure::read('emailfrom'))
                    ->viewVars(['content' => $message]);
                if ($email->send()) {
                    die(true);
                } else {
                    die(false);
                }
            }
        }
    }

    public function updateInfo()
    {
        header('Content-Type: text/xml');
        $changelogUrl = \Cake\Routing\Router::url(['controller' => 'Pages', 'action' => 'greencloudChangelog'], true);
        $latestVersion = '1.0.1.2';
        $downloadUrl = \Cake\Routing\Router::url('/downloads/setup_' . $latestVersion . '.exe', true);

        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<item>
<version>$latestVersion</version>
<url>$downloadUrl</url>
<changelog>$changelogUrl</changelog>
</item>";
        die($xml);
    }

    public function greencloudChangelog()
    {
        $this->viewBuilder()->layout('default');
        $this->render('greencloud_changelog');
    }

    public function launchWebSigner()
    {

    }
}
