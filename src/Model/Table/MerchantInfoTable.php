<?php
namespace App\Model\Table;

use App\Model\Entity\MerchantInfo;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MerchantInfo Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\BelongsTo $PaymentStructures
 * @property \Cake\ORM\Association\BelongsTo $LoyaltyPrograms
 * @property \Cake\ORM\Association\BelongsTo $Countries
 */
class MerchantInfoTable extends Table
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

        $this->table('merchant_info');
        $this->displayField('name');

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
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('CreatedByUser', [
            'foreignKey' => 'created_by',
            'className' => 'Users'
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
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->allowEmpty('code');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
            ->allowEmpty('address_line_1');

        $validator
            ->allowEmpty('address_line_2');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('parish_state');

        $validator
            ->decimal('print_cost')
            ->allowEmpty('print_cost');

        $validator
            ->allowEmpty('username');

        $validator
            ->allowEmpty('password');

        $validator
            ->boolean('is_active')
            ->allowEmpty('is_active');

        $validator
            ->boolean('is_locked')
            ->allowEmpty('is_locked');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        $validator
            ->boolean('deleted')
            ->allowEmpty('deleted');

        $validator
            ->dateTime('date_deleted')
            ->allowEmpty('date_deleted');

        $validator
            ->integer('deleted_by')
            ->allowEmpty('deleted_by');

        $validator
            ->allowEmpty('deactivate_note');

        $validator
            ->integer('low_credit_alert_amount')
            ->allowEmpty('low_credit_alert_amount');

        $validator
            ->boolean('send_low_credit_email')
            ->allowEmpty('send_low_credit_email');

        $validator
            ->requirePresence('receipt_count', 'create')
            ->notEmpty('receipt_count');

        $validator
            ->decimal('credits_used')
            ->requirePresence('credits_used', 'create')
            ->notEmpty('credits_used');

        $validator
            ->decimal('credits_purchased')
            ->allowEmpty('credits_purchased');

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
}
