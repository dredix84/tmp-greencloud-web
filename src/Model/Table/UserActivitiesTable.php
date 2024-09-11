<?php
namespace App\Model\Table;

use App\Model\Entity\UserActivity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserActivities Model
 *
 */
class UserActivitiesTable extends Table
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

        $this->table('user_activities');
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        $validator
            ->allowEmpty('after_action');

        $validator
            ->allowEmpty('ip_address');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('note');

        $validator
            ->add('risk', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('risk');

        $validator
            ->allowEmpty('other_data');

        $validator
            ->add('flag', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('flag');

        return $validator;
    }
}
