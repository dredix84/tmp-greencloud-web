<?php
namespace App\Model\Table;

use App\Model\Entity\Payment;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Merchants
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Certificates
 * @property \Cake\ORM\Association\BelongsTo $PaymentTransactions
 * @property \Cake\ORM\Association\BelongsTo $SubscriptionTransactions
 * @property \Cake\ORM\Association\HasMany $Credits
 */
class PaymentsTable extends Table
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
        $this->addBehavior('Ceeram/Blame.Blame');
        
        $this->table('payments');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Merchants', [
            'foreignKey' => 'merchant_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Credits', [
            'foreignKey' => 'payment_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('paypal_token');

        $validator
            ->allowEmpty('billing_name');

        $validator
            ->allowEmpty('billing_street');

        $validator
            ->allowEmpty('billing_city');

        $validator
            ->allowEmpty('billing_state');

        $validator
            ->allowEmpty('billing_zip');

        $validator
            ->allowEmpty('billing_country');

        $validator
            ->allowEmpty('billing_phone');

        $validator
            ->decimal('subtotal')
            ->allowEmpty('subtotal');

        $validator
            ->decimal('tax')
            ->allowEmpty('tax');

        $validator
            ->decimal('couponamount')
            ->allowEmpty('couponamount');

        $validator
            ->decimal('certificateamount')
            ->allowEmpty('certificateamount');

        $validator
            ->decimal('total')
            ->allowEmpty('total');

        $validator
            ->allowEmpty('payment_type');

        $validator
            ->allowEmpty('cardtype');

        $validator
            ->allowEmpty('accountnumber');

        $validator
            ->integer('expirationmonth')
            ->allowEmpty('expirationmonth');

        $validator
            ->integer('expirationyear')
            ->allowEmpty('expirationyear');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('gateway');

        $validator
            ->allowEmpty('gateway_environment');

        $validator
            ->allowEmpty('note');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

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
        $rules->add($rules->isUnique(['code']));
        $rules->add($rules->existsIn(['merchant_id'], 'Merchants'));
        return $rules;
    }
}
