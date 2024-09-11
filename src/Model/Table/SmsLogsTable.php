<?php

namespace App\Model\Table;

use App\Model\Entity\Merchant;
use App\Model\Entity\Receipt;
use App\Model\Entity\SmsLog;
use App\Model\Entity\User;
use App\Service\CurrencyConverter;
use App\Service\LogHandler;
use App\Service\SmsHandler;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Routing\Router;
use Cake\Validation\Validator;

/**
 * SmsLogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Receipts
 * @property \Cake\ORM\Association\BelongsTo $Merchants
 */
class SmsLogsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        //$this->addBehavior('Ceeram/Blame.Blame');

        $this->table('sms_logs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Receipts', [
            'foreignKey' => 'receipt_id'
        ]);
        $this->belongsTo('Merchants', [
            'foreignKey' => 'merchant_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('sms_type', 'create')
            ->notEmpty('sms_type');

        $validator
            ->requirePresence('phone_number', 'create')
            ->notEmpty('phone_number');

        $validator
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        $validator
            ->date('sent')
            ->allowEmpty('sent');

        $validator
            ->allowEmpty('send_via');

        $validator
            ->boolean('errored')
            ->allowEmpty('errored');

        $validator
            ->decimal('cost')
            ->allowEmpty('cost');

        $validator
            ->decimal('rate')
            ->allowEmpty('rate');

        $validator
            ->allowEmpty('currency');

        $validator
            ->decimal('exchange_rate')
            ->allowEmpty('exchange_rate');

        $validator
            ->allowEmpty('gateway_response');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['receipt_id'], 'Receipts'));
        $rules->add($rules->existsIn(['merchant_id'], 'Merchants'));
        return $rules;
    }


    public function sendReceiptSms(Receipt $receipt, Merchant $merchant, User $user)
    {

        if ($merchant->send_sms && !empty($user->phone)) {
            $currencyHandler = new CurrencyConverter(
                Configure::read('currency.api_key'),
                $merchant->payment_structure->currency,
                $merchant->currency
            );

            /** @var SmsLog $sms */
            $sms = $this->newEntity();
            $sms->receipt_id = $receipt->id;
            $sms->merchant_id = $merchant->id;
            $sms->sms_type = 'receipt';
            $sms->phone_number = $user->phone;
//            $sms->phone_number = '8764826544';
            $sms->message = $this->getSmsReceiptBody($receipt, $merchant);
            $sms->sent = null;
            $sms->send_via = 'API';
            $sms->errored = false;
            $sms->cost = $currencyHandler->convert($merchant->payment_structure->cost_per_sms);
            $sms->rate = $merchant->payment_structure->cost_per_sms;
            $sms->currency = $merchant->payment_structure->currency;
            $sms->exchange_rate = $currencyHandler->getRate();

            LogHandler::debug('SMS Log', $sms->toArray());
            if ($this->save($sms)) {
                $sendResult = $this->sendSMS($sms);
                return false !== $sendResult ? true : false;
            } else {
                LogHandler::warning(
                    'SMS: unable to save sms_log entry for receipt ID: ' . $receipt->id,
                    $sms->getErrors()
                );
            }
        } else {
            LogHandler::debug(
                "SMS: Not sent because phone # is not present or SMS is turned off for merchant",
                [
                    "merchant_id" => $merchant->id,
                    'receipt_id' => $receipt->id,
                    "merchant_send_sms" => $merchant->send_sms,
                    "phone_number_resent" => !empty($user->phone)
                ]
            );
        }
        return false;
    }

    /**
     * @param SmsLog $sms
     * @return bool|string
     */
    public function sendSMS(SmsLog $sms)
    {
        $smmSendHandler = new SmsHandler($sms->phone_number, $sms->message);
        $sendResult = $smmSendHandler->sendSmsWithRetry();
//        $sendResult = 'ok test';
        if (false !== $sendResult) {
            $sms->sent = new Time();
            $sms->gateway_response = $sendResult;
            LogHandler::info('SMS: Send result', ['result' => $sendResult]);
        } else {
            $sms->errored = true;
            LogHandler::warning('SMS: unable to send sms ID: ' . $sms->id);
        }
        $this->save($sms);

        return $sendResult;
    }

    /**
     * @param Receipt $receipt
     * @param Merchant $merchant
     * @return string
     */
    public function getSmsReceiptBody(Receipt $receipt, Merchant $merchant)
    {
        $template = "Green Cloud receipt from %s. Invoice #%s for \$%s. %s. Link: %s";
        $smsDate = new Time();
        $smsBody = sprintf(
            $template,
            $merchant->name,
            $receipt->receipt_number,
            $receipt->total,
            $smsDate->toFormattedDateString(),
//            'https://variantsol.com/greencloud/r'
            Router::url(['controller' => 'r', $receipt->id], true)
        );
        return $smsBody;
    }
}
