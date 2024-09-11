<?php

namespace App\Model\Table;

use App\Model\Entity\Merchant;
use App\Model\Traits\TableCommon;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Merchants Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\BelongsTo $PaymentStructures
 * @property \Cake\ORM\Association\BelongsTo $LoyaltyPrograms
 * @property \Cake\ORM\Association\HasMany $Activeusers
 * @property \Cake\ORM\Association\HasMany $Credits
 * @property \Cake\ORM\Association\HasMany $Locations
 * @property \Cake\ORM\Association\HasMany $MerchantUsers
 * @property \Cake\ORM\Association\HasMany $Payments
 * @property \Cake\ORM\Association\HasMany $Receipts
 * @property \Cake\ORM\Association\HasMany $Users
 */
class MerchantsTable extends Table
{

    use TableCommon;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Ceeram/Blame.Blame');

        $this->setTable('merchants');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id'
        ]);
        $this->belongsTo('PaymentStructures', [
            'foreignKey' => 'payment_structure_id'
        ]);
        $this->belongsTo('LoyaltyPrograms', [
            'foreignKey' => 'loyalty_program_id'
        ]);
        $this->belongsTo('CratedByUser', [
            'foreignKey' => 'created_by',
            'className'  => 'Users'
        ]);
        $this->hasMany('Activeusers', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Credits', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Locations', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('MerchantUsers', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Receipts', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('SmsLogs', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Countries', [
            'foreignKey' => 'country_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('code');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->notEmpty('industry_id');

        $validator
            ->allowEmpty('about');

        $validator
            ->allowEmpty('logo');

        $validator
            ->allowEmpty('contact_name');

        $validator
            ->allowEmpty('contact_phone');

        $validator
            ->allowEmpty('contact_position');

        $validator
            ->allowEmpty('contact_email');

        $validator
            ->allowEmpty('website');

        $validator
            ->add('print_cost', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('print_cost');

        $validator
            ->allowEmpty('username');

        $validator
            ->allowEmpty('password');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_active');

        $validator
            ->add('is_locked', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_locked');

        $validator
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['industry_id'], 'Industries'));
        $rules->add($rules->existsIn(['payment_structure_id'], 'PaymentStructures'));
        $rules->add($rules->existsIn(['loyalty_program_id'], 'LoyaltyPrograms'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }

    public function checkAccess($user, $pass)
    {
        $m = $this->find('all', [
            'conditions' => [
                'username' => $user,
                'password' => $pass,
            ],
            'contain'    => ['PaymentStructures', 'LoyaltyPrograms']
        ])->first();
        if (!empty($m)) {
            $contactinfo = \Cake\Core\Configure::read('contactinfo_text');
            if ($m->id > 0) {
                if ($m->is_active == 0) {
                    $app_name      = \Cake\Core\Configure::read('app_name');
                    $m->authorized = 0;
                    $m->msg        = "Merchant account ({$m->name}) not active.\nPlease contact a $app_name representative.\n\nYou may contact a representative by $contactinfo";
                } elseif ($m->is_locked == 1) {
                    $app_name      = \Cake\Core\Configure::read('app_name');
                    $m->authorized = 0;
                    $m->msg        = "Merchant account ({$m->name}) is locked.\nPlease contact a $app_name representative.\n\nYou may contact a representative by $contactinfo";
                } else {
                    $m->authorized = 1;
                    $m->msg        = "Acount is active";
                }
            } else {
                $m             = new \stdClass();
                $m->authorized = 0;
                $m->msg        = "Invalid username and password";
            }
        } else {
            $m             = new \stdClass();
            $m->authorized = 0;
            $m->msg        = "Invalid username and password";
        }

        return $m;
    }

    /**
     * Used to get the merchant the customer has done business with in the last
     * @param int $customerID Customer ID
     * @return array
     */
    public function customerMerchants($customerID)
    {
        $merchants = [];
        $baseSQL   = "SELECT DISTINCT receipts.merchant_id as id, merchants.`name` as name
FROM merchants
INNER JOIN receipts ON receipts.merchant_id = merchants.id
WHERE receipts.user_id = ?";
        $dbDate    = $this->getDbData($baseSQL, [$customerID]);
        if (count($dbDate)) {
            foreach ($dbDate as $m) {
                $merchants[$m['id']] = $m['name'];
            }
        }
        return $merchants;
    }

    public function activeMerchant($options)
    {
        /** @var ReceiptsTable $receiptsModel */
        $receipts = TableRegistry::get('Receipts')
            ->find()
            ->select(['merchant_id'])
            ->distinct(['merchant_id']);
        $smsLogs  = TableRegistry::get('SmsLogs')->find()
            ->select(['merchant_id'])
            ->distinct(['merchant_id']);

        if (isset($options['merchant_id'])) {
            $receipts = $receipts->where(['merchant_id' => $options['merchant_id']]);
            $smsLogs  = $smsLogs->where(['merchant_id' => $options['merchant_id']]);
        }
        if (isset($options['start_date'])) {
            $receipts = $receipts->where(['created >=' => $options['start_date']]);
            $smsLogs  = $smsLogs->where(['created >=' => $options['start_date']]);
        }
        if (isset($options['end_date'])) {
            $receipts = $receipts->where(['created <=' => $options['end_date']]);
            $smsLogs  = $smsLogs->where(['created <=' => $options['end_date']]);
        }
        if (isset($options['date_range'])) {
            $receipts = $receipts
                ->where(['created >=' => $options['date_range'][0]])
                ->andWhere(['created <=' => $options['date_range'][1]]);
            $smsLogs  = $smsLogs
                ->where(['created >=' => $options['date_range'][0]])
                ->andWhere(['created <=' => $options['date_range'][1]]);
        }
        $outData = [];

        foreach ($receipts as $receipt) {
            $outData[] = $receipt->merchant_id;
        }
        foreach ($smsLogs as $smsLog) {
            if (!in_array($smsLog->merchant_id, $outData)) {
                $outData[] = $smsLog->merchant_id;
            }
        }
        return $outData;
    }

    public function getList($limit = null)
    {
        $outData = [];
        $options = [
            'fields' => ['id', 'name', 'city']
        ];
        if ($limit) {
            $options['limit'] = $limit;
        }
        $merchants = $this->find('all', $options);
        foreach ($merchants as $merchant) {
            /** @var Merchant $merchant */
            $outData[$merchant->id] = $merchant->business_title;
        }

        return $outData;
    }
}
