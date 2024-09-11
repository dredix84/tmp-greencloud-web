<?php

namespace App\Model\Table;

use App\Model\Entity\Credit;
use App\Model\Traits\TableCommon;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Credits Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Merchants
 * @property \Cake\ORM\Association\BelongsTo $Payments
 */
class CreditsTable extends Table {

	use TableCommon;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Ceeram/Blame.Blame');

        $this->table('credits');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Merchants', [
            'foreignKey' => 'merchant_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Payments', [
            'foreignKey' => 'payment_id'
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
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

        $validator
                ->add('credit_amount', 'valid', ['rule' => 'numeric'])
                ->requirePresence('credit_amount', 'create')
                ->notEmpty('credit_amount');

        $validator
                ->allowEmpty('note');

        $validator
                ->add('added_by', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('added_by');

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
        $rules->add($rules->existsIn(['merchant_id'], 'Merchants'));
        $rules->add($rules->existsIn(['payment_id'], 'Payments'));
        return $rules;
    }
    
    /**
     * Used to save credit to a merchant account
     * @param int $merchant_id Mechant ID
     * @param int $payment_id  Payment ID (Set to null if none)
     * @param int $credit_amount   Credit Amount to add
     * @param string $note    Note to add to account
     * @param int $added_by    Who add this credit
     * @return boolean
     */
    public function addCredits($merchant_id, $payment_id, $credit_amount, $note, $added_by) {
        $credit = $this->newEntity(compact('merchant_id', 'payment_id', 'credit_amount', 'note', 'added_by'));
        return $this->save($credit);
    }

    /**
     * Queries for credits purchased based on merchant ID and date
     * @param int $merchant_id Merchant ID
     * @param string $start_date  Start Date (yyyy-mm-dd)
     * @param string $end_date    End Date (yyyy-mm-dd)
     * @return array
     */
    public function getCreditsPurchaed($merchant_id, $start_date = null, $end_date = null) {
        $conn = $this->getConnection();
        $params = [$merchant_id];
        $baseSQL = "SELECT c.* FROM credits AS c WHERE c.merchant_id = ?";
        if(!empty($start_date)){
            $baseSQL .= " AND DATE_FORMAT(c.created, '%Y-%m-%d') >= ? ";
        }
        if(!empty($end_date)){
            $baseSQL .= " AND DATE_FORMAT(c.created, '%Y-%m-%d') <= ? ";
        }
        $result = $conn->execute($baseSQL, $params)->fetchAll('assoc');
        return $result;
    }

}
