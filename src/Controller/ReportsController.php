<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\MerchantsTable;
use Cake\Network\Exception\NotFoundException;
use Cake\Controller\Component\RequestHandlerComponent;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class ReportsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        //$this->Auth->allow(['index', 'add', 'edit']);  //@TODO: Set permissions in Roles controller
    }

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->Permission->controllerPermission($this->request);
    }

    public function index()
    {

    }

    public function monthlyActivity()
    {
        $this->loadModel('Receipts');
        $where  = "";
        $params = [];
        if ($this->Permission->isAdmin()) {

        } elseif ($this->userinfo['role_id'] == 1) {
            $where    = " AND r.user_id = ?";
            $params[] = $this->userinfo['id'];
        } elseif ($this->userinfo['role_id'] == 2) {
            $where    = " AND r.merchant_id = ?";
            $params[] = $this->userinfo['merchant_id'];
        } elseif ($this->userinfo['role_id'] == 3) {
            $where    = " AND r.provider_id = ?";
            $params[] = $this->userinfo['provider_id'];
        } else {
            $where    = " AND r.user_id = ?";
            $params[] = $this->userinfo['id'];
        }
        if ($this->request->is('post') || isset($_REQUEST['merchant_id'])) {   //Normal search fields
            $allowedFields = ['policy_number', 'claim_number', 'merchant_id', 'receipt_date', 'total', 'provider_id'];
            $termField     = ['policy_number', 'claim_number'];
            $d             = &$this->request->data;
            if (isset($_REQUEST['merchant_id'])) {
                $d['merchant_id'] = $_REQUEST['merchant_id'];
            }

            //Search fields
            foreach ($allowedFields as $sf) {
                if (!empty($d[$sf])) {
                    $where    .= " AND r.$sf = ?";
                    $params[] = $d[$sf];
                }
            }

            if (!empty($d['start-date'])) {     //Start and End date
                $where    .= " AND r.receipt_date >= ? AND r.receipt_date <= ?";
                $params[] = $d['start-date'];
                $params[] = $d['end-date'];
            }

            if (!empty($d['search_term'])) {    //Search term
                foreach ($termField as $sf) {
                    $where    .= " AND r.$sf = ?";
                    $params[] = $d['search_term'];
                }
            }
        }
        $data = $this->Receipts->getMonthlyActivity($where, $params);
        $this->set(compact('data'));
        $this->set('merchants', $this->Receipts->Merchants->find('list', ['order' => ['Merchants.name' => 'ASC']]));
        $this->set('providers', $this->Receipts->Providers->find('list', ['order' => ['Providers.name' => 'ASC']]));
    }

    public function merchantSummary()
    {
        $this->loadModel('Receipts');
        $where  = "";
        $params = [];
        if ($this->Permission->isAdmin()) {

        } elseif ($this->userinfo['role_id'] == 1) {
            $where    = " AND r.user_id = ?";
            $params[] = $this->userinfo['id'];
        } elseif ($this->userinfo['role_id'] == 2) {
            $where    = " AND r.merchant_id = ?";
            $params[] = $this->userinfo['merchant_id'];
        } elseif ($this->userinfo['role_id'] == 3) {
            $where    = " AND r.provider_id = ?";
            $params[] = $this->userinfo['provider_id'];
        } else {
            $where    = " AND r.user_id = ?";
            $params[] = $this->userinfo['id'];
        }

        if ($this->request->is('post')) {   //Normal search fields
            $allowedFields = ['merchant_id', 'receipt_date', 'total'];
            $termField     = ['policy_number', 'claim_number'];
            $d             = &$this->request->data;

            foreach ($allowedFields as $sf) {//Search fields
                if (!empty($d[$sf])) {
                    $where    .= " AND r.$sf = ?";
                    $params[] = $d[$sf];
                }
            }

            if (!empty($d['start-date'])) {     //Start and End date
                $where    .= " AND r.receipt_date >= ? AND r.receipt_date <= ?";
                $params[] = $d['start-date'];
                $params[] = $d['end-date'];
            }
        }

        $data = $this->Receipts->getMerchantSummary($where, $params);
        $this->set(compact('data'));
        $this->set('merchants', $this->Receipts->Merchants->find('list', ['order' => ['Merchants.name' => 'ASC']]));
    }

    public function creditUsageSummary($reporttype = 'month', $periodlimit = 6)
    {
        $this->loadModel('Receipts');
        $totals       = $this->Receipts->getCreditsUsedAndPurchasedTotal($this->userinfo['merchant_id']);
        $usageData    = $this->Receipts->getCreditsUsedOverPeriod($this->userinfo['merchant_id'], $reporttype,
            $periodlimit);
        $purchaseData = $this->Receipts->getCreditsPurchasedOverPeriod($this->userinfo['merchant_id'], $reporttype,
            $periodlimit);

        $this->set(compact('usageData', 'purchaseData', 'reporttype', 'periodlimit', 'totals'));
    }

    public function creditsPurchhased()
    {
        $this->loadModel('Credits');
        if ($this->request->is('post')) {
            if (!empty($d['start-date'])) {     //Start and End date
                $where    .= " AND r.receipt_date >= ? AND r.receipt_date <= ?";
                $params[] = $d['start-date'];
                $params[] = $d['end-date'];
            }
        }
    }

    public function adminMonthMerchantReceipts()
    {
        $this->loadModel('Receipts');


        $this->set('merchants', $this->Receipts->Merchants->find('list', ['order' => ['Merchants.name' => 'ASC']]));
        $this->set('providers', $this->Receipts->Providers->find('list', ['order' => ['Providers.name' => 'ASC']]));
    }

    public function merchantBilling()
    {
        if ($this->userinfo['role_id'] !== 4) {
            throw new NotFoundException();
        }
        $this->loadModel('Receipts');

        $merchants = $this->Receipts->Merchants->find(
            'all',
            [
                'order'  => ['Merchants.name' => 'ASC'],
                'fields' => ['id', 'name', 'city']
            ]
        );
        $this->set(compact('merchants'));
    }


    public function getMerchantBilling()
    {
        if ($this->userinfo['role_id'] !== 4) {
            throw new NotFoundException();
        }
        /** @var MerchantsTable $merchantTable */
        $merchantTable   = $this->loadModel('Merchants');
        $conditions      = $this->request->getQueryParams();
        $activeMerchants = $merchantTable->activeMerchant($conditions);

        $merchants = $merchantTable->find('all')
            ->contain([
                'Receipts' => [
                    'fields'     => [
                        'id',
                        'merchant_id',
                        'receipt_number',
                        'receipt_date',
                        'credits_used',
                        'merchant_receipt_cost',
                        'payment_type_id',
                        'send_sms',
                        'created'
                    ],
                    'conditions' => [
                        'Receipts.created >= ' => $conditions['date_range'][0],
                        'Receipts.created <= ' => $conditions['date_range'][1],
                    ]
                ],
                'SmsLogs'  => [
                    'fields'     => [
                        'id',
                        'merchant_id',
                        'cost',
                        'rate',
                        'exchange_rate',
                        'phone_number',
                        'currency',
                        'errored',
                        'created',
                        "receipt_number" => "(SELECT receipts.receipt_number FROM receipts WHERE SmsLogs.receipt_id = receipts.id)"
                    ],
                    'conditions' => [
                        'SmsLogs.created >= ' => $conditions['date_range'][0],
                        'SmsLogs.created <= ' => $conditions['date_range'][1],
                    ]
                ],
            ])
            ->select(['id', 'name', 'city', 'parish_state'])
            ->where([
                'Merchants.id IN ' => $activeMerchants,
            ]);

        if (isset($conditions['type']) && $conditions['type'] === 'xlsx') {
            $xlsData = [
                ['Name', $merchants->toArray()[0]['name']],
                ['Location', sprintf('%s, %s', $merchants->toArray()[0]['city'], $merchants->toArray()[0]['parish_state'])],
                ['Start Date', $conditions['date_range'][0]],
                ['End Date', $conditions['date_range'][1]],
                ['Receipts', count($merchants->toArray()[0]['receipts']), '$0'],
                ['SMSs', count($merchants->toArray()[0]['sms_logs']), '$0'],
                ['Total', '', '$0'],
                [],
                ['ID', 'Type', 'Receipt #', 'Cost', 'Date', 'Details']
            ];

            $receiptTotal = 0;
            foreach ($merchants->toArray()[0]['receipts'] as $receipt) {
                $receiptTotal += $receipt->credits_used;
                $xlsData[]    = [
                    $receipt->id,
                    'Receipt',
                    $receipt->receipt_number,
                    $receipt->credits_used,
                    $receipt->created->nice(),
                    $receipt->send_sms ? "With SMS" : ''
                ];
            }
            $xlsData[4][2] = "$" . $receiptTotal;

            $smsTotal = 0;
            foreach ($merchants->toArray()[0]['sms_logs'] as $smsLog) {
                $smsTotal  += $smsLog->cost;
                $xlsData[] = [
                    $smsLog->id, 'SMS', $smsLog->receipt_number, $smsLog->cost, $smsLog->created->nice(), $smsLog->phone_number
                ];
            }
            $xlsData[5][2] = "$" . $smsTotal;
            $xlsData[6][2] = "$" . ($receiptTotal + $smsTotal);

            $xlsx = \SimpleXLSXGen::fromArray($xlsData);
            $xlsx->downloadAs(sprintf('merchant_billing-%s-%s.xlsx', $conditions['merchant_id'], time()));
            die;
        } else {
            $this->set('merchants', $merchants);
        }
    }
}
