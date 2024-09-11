<?php
namespace App\Model\Table;

use App\Model\Entity\Page;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pages Model
 *
 */
class PagesTable extends Table
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

        $this->table('pages');
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
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->allowEmpty('excerpt');

        $validator
            ->add('show_on _menu', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('show_on _menu');

        $validator
            ->add('menu_order', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('menu_order');

        $validator
            ->add('available', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('available');

        $validator
            ->add('available_on', 'valid', ['rule' => 'date'])
            ->allowEmpty('available_on');

        return $validator;
    }
}
