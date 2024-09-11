<?php

namespace App\Model\Table;

use App\Model\Entity\Invoice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InvoiceStatuses
 * @property \Cake\ORM\Association\BelongsTo $Merchants
 * @property \Cake\ORM\Association\BelongsTo $ToMerchants
 */
class InvoicesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        //$this->addBehavior('Ceeram/Blame.Blame');

        $this->table('invoices');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('InvoiceStatuses', [
            'foreignKey' => 'invoice_status_id'
        ]);
        $this->belongsTo('Merchants', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->belongsTo('ToMerchants', [
            'foreignKey' => 'to_merchant_id',
            'className' => 'Merchants'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('invoice_number', 'create')
                ->notEmpty('invoice_number');

        $validator
                ->date('invoice_date')
                ->requirePresence('invoice_date', 'create')
                ->notEmpty('invoice_date');

        $validator
                ->date('due_date')
                ->allowEmpty('due_date');

        $validator
                ->allowEmpty('from_address');

        $validator
                ->allowEmpty('to_address');

        $validator
                ->decimal('shipping')
                ->allowEmpty('shipping');

        $validator
                ->integer('discount_type')
                ->allowEmpty('discount_type');

        $validator
                ->decimal('discount')
                ->allowEmpty('discount');

        $validator
                ->decimal('sub_total')
                ->allowEmpty('sub_total');

        $validator
                ->decimal('grand_total')
                ->allowEmpty('grand_total');

        $validator
                ->boolean('paid')
                ->allowEmpty('paid');

        $validator
                ->allowEmpty('note');

        $validator
                ->allowEmpty('private_note');

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
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['invoice_status_id'], 'InvoiceStatuses'));
        $rules->add($rules->existsIn(['merchant_id'], 'Merchants'));
        $rules->add($rules->existsIn(['to_merchant_id'], 'ToMerchants'));
        return $rules;
    }

}
