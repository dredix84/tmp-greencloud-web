<?php


namespace App\Controller;


use App\Model\Entity\Merchant;
use App\Model\Entity\Receipt;
use App\Model\Entity\User;
use App\Model\Table\ReceiptsTable;
use App\Service\CurrencyConverter;
use App\Service\SmsHandler;

class TestController extends AppController
{

    public function index()
    {
        $smsHandler = new SmsHandler('18765781174', 'This is an app test message at ' . time());
        \Kint::dump($smsHandler->sendSmsWithRetry(), $smsHandler->getSendAttempts());
        die;
    }

    public function phpinfo()
    {
        phpinfo();
    }

    public function convert($amount, $from = 'USD', $to = 'JMD')
    {
//        $currencyConverter = new CurrencyConverter( '0fec3e969c5319e62111' );
//        $currencyConverter
//            ->setBaseCurrency( $from )
//            ->setTargetCurrency( $to );
//
//        $rate = $currencyConverter->convert($amount);
        \Kint::dump(CurrencyConverter::convertAmount($amount));
        die;
    }


    public function saveSms($rid = 38667, $mid = 50)
    {
        $this->loadModel('Receipts');
        $this->loadModel('Merchants');
        $this->loadModel('Users');
        $this->loadModel('SmsLogs');

        /** @var Merchant $m */
        $m = $this->Merchants->get($mid, ['contain' => ['PaymentStructures', 'LoyaltyPrograms']]);
        $m->send_sms = true;

        /** @var Receipt $r */
        $r = $this->Receipts->get($rid);

        /** @var User $u */
        $u = $this->Users->get($r->user_id);
        $u->phone = '8764826544';
        $this->SmsLogs->sendReceiptSms($r, $m, $u);

        \Kint::dump($m, $r, $u);
        die;
    }


    public function emailTest($receiptId = null)
    {
        $receipt = null;
        if ($receiptId === null) {
            /** @var ReceiptsTable $ReceiptsTable */
            $ReceiptsTable = $this->loadModel('Receipts');
            $receipt = $ReceiptsTable->find('all')->orderDesc('id')->firstOrFail();
            $receiptId = $receipt->id;
        } else {
            /** @var ReceiptsTable $ReceiptsTable */
            $ReceiptsTable = $this->loadModel('Receipts');
            $receipt = $ReceiptsTable->find(
                'all',
                [
                    'conditions' => [
                        'id' => $receiptId
                    ]
                ]
            )->orderDesc('id')->firstOrFail();
            $receiptId = $receipt->id;
        }
        try {
            \Kint::dump(
                'Success',
                $ReceiptsTable->sendCustomerEmailNotification($receiptId, 'dredix84@gmail.com'),
                $receipt->toArray(),
                $receiptId
            );
        } catch (\Exception $exception) {
            \Kint::dump(
                'FAILED',
                $exception,
                $receiptId
            );
        }
        die;
    }

}
