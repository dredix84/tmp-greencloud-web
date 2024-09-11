<?php
namespace App\Model\Table;

use App\Model\Entity\PaymentStructure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PaymentStructures Model
 *
 * @property \Cake\ORM\Association\HasMany $Merchants
 */
class PaymentStructuresTable extends Table
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

        $this->table('payment_structures');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Merchants', [
            'foreignKey' => 'payment_structure_id'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->allowEmpty('description');

        $validator
            ->add('cost_per_receipt', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('cost_per_receipt');

        $validator
            ->add('percent_per_receipt', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('percent_per_receipt');

        $validator
            ->allowEmpty('currency');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_active');

        $validator
            ->add('is_default', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_default');

        $validator
            ->add('expiry_date', 'valid', ['rule' => 'date'])
            ->allowEmpty('expiry_date');

        $validator
            ->add('created_by', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('created_by');

        $validator
            ->add('modified_by', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('modified_by');

        return $validator;
    }
}
