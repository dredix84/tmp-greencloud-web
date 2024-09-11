<?php
namespace App\Model\Table;

use App\Model\Entity\LoyaltyProgram;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LoyaltyPrograms Model
 *
 */
class LoyaltyProgramsTable extends Table
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

        $this->table('loyalty_programs');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->add('percentage_per_receipt', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('percentage_per_receipt');

        $validator
            ->add('point_per_receipt', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('point_per_receipt');

        $validator
            ->add('points_cost_ratio', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('points_cost_ratio');

        $validator
            ->add('payout_threshold', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('payout_threshold');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_active');

        $validator
            ->add('is_default', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_default');

        $validator
            ->add('created_by', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('created_by');

        $validator
            ->add('modified_by', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('modified_by');

        return $validator;
    }
}
