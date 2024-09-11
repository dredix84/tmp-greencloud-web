<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\SmsLog;
use Cake\Network\Exception\NotFoundException;

/**
 * SmsLogs Controller
 *
 * @property \App\Model\Table\SmsLogsTable $SmsLogs
 */
class SmsLogsController extends AppController
{

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->Permission->controllerPermission($this->request);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = array();
        if (!$this->Permission->isAdmin()) {
            $conditions = ['SmsLogs.merchant_id' => $this->userinfo['merchant_id']];
        }

        if (isset($_REQUEST['a'])) {
            $this->request->data = array_filter($_REQUEST);

            $r = &$this->request->data;
            if (isset($r['search_term']) && !empty($r['search_term'])) {
                $term = trim($r['search_term']);
                $orFields = ['phone_number', 'sms_type', 'send_via'];
                if (count($orFields) == 0) {
                    $this->Flash->error('SmsLogs has no search fields added. Contact developer', 'bad');
                    $this->log('[EmptySearch] SmsLogs index page search field have no added field options.');
                }
                for ($i = 0; $i < count($orFields); $i++) {
                    $conditions["OR"]['SmsLogs.' . $orFields[$i] . ' LIKE'] = "%$term%";
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
        $this->paginate = [
            'contain' => ['Receipts', 'Merchants']
        ];
        $this->set('smsLogs', $this->paginate($this->SmsLogs->find('all', ['conditions' => $conditions])));
        $this->set('_serialize', ['smsLogs']);
    }

    /**
     * View method
     *
     * @param string|null $id Sms Log id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        /** @var SmsLog $smsLog */
        $smsLog = $this->SmsLogs->get($id, [
            'contain' => ['Receipts', 'Merchants']
        ]);
        if (!$this->Permission->isAdmin() && $smsLog->merchant_id !== $this->userinfo['merchant_id']) {
            throw new NotFoundException();
        }
        $this->set('smsLog', $smsLog);
        $this->set('_serialize', ['smsLog']);
    }
}
