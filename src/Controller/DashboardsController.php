<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ReceiptsTable;
use Cake\I18n\Date;

/**
 * Class DashboardsController
 * @package App\Controller
 *
 * @property ReceiptsTable $Receipts
 */
class DashboardsController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Receipts');
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->loginChecks();
    }

    protected function loginChecks() {
        $u = $this->Auth->user();
        if ($u['role_id'] == 2) {   //Merchant Checks
            if ($u['merchant_id'] == -1)
                $this->Flash->default('Now that you have activated your account, it is now time to setup the merchant details. Use the link below to setup the merchant account.');
        }
    }

    public function index() {
        $u = $this->Auth->user();
        if ($u['role_id'] == 1) {   //Customer
            $receiptCnt = $this->Receipts->getReceiptCount($u['id']);
            $receiptNewCnt = $this->Receipts->getReceiptCount($u['id'], ['seen' => 0]);
            $loyaltyPoints = $this->Receipts->getCustomerLoyalty($u['id']);
            $loyaltyPointsToday = $this->Receipts->getCustomerLoyaltyforDate($u['id'], date('Y-m-d'));
            $this->set(compact('receiptCnt', 'receiptNewCnt', 'loyaltyPoints', 'loyaltyPointsToday'));

        } elseif ($u['role_id'] == 2) { //Merchant
            $txnCount = $this->Receipts->getCount(['merchant_id' => $u['merchant_id'], "DATE_FORMAT(created,'%Y-%m-%d')" => date('Y-m-d')]);
            $txnAmount = $this->Receipts->getTransactionAmountByDate($u['merchant_id']);
            $creditsUsedToday = $this->Receipts->getCreditsUsedToday($u['merchant_id']);
            $creditsRemaining = $this->Receipts->getCreditsRemaining($u['merchant_id']);
            $this->set(compact('txnCount', 'txnAmount', 'creditsRemaining', 'creditsUsedToday'));

        } elseif ($u['role_id'] == 3) { //Provider
            $txnCount = $this->Receipts->getCount(['provider_id' => $u['provider_id'], "DATE_FORMAT(created,'%Y-%m-%d')" => date('Y-m-d')]);
            $txnAmount = $this->Receipts->getTransactionAmountByDate($u['merchant_id']);
            $this->set(compact('txnCount', 'txnAmount'));
        } elseif ($u['role_id'] == 4) { //Admins
            $this->loadModel('Users');
            $nowDate = Date::now();
            $roleUserCount = $this->Users->getRoleUserCount();
            $registeredVsUnregisteredUser = $this->Users->getRegisteredVsUnregisteredUser();

            $todaysTxnByMerchant = $this->Receipts->getTransactionsByMerchant($nowDate->format('Y-m-d'));
            $yesterdayTxnByMerchant = $this->Receipts->getTransactionsByMerchant($nowDate->subDay(1)->format('Y-m-d'));

            $this->set(compact('roleUserCount', 'registeredVsUnregisteredUser', 'todaysTxnByMerchant', 'yesterdayTxnByMerchant'));
        }
    }

}
