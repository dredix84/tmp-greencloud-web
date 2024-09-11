<?php

namespace App\Model\Table;

use App\Model\Entity\AutoAction;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AutoActions Model
 *
 */
class AutoActionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        //$this->addBehavior('Ceeram/Blame.Blame');

        $this->table('auto_actions');
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
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('title', 'create')
                ->notEmpty('title');

        $validator
                ->requirePresence('action_type', 'create')
                ->notEmpty('action_type');

        $validator
                ->integer('row_count')
                ->allowEmpty('row_count');

        $validator
                ->allowEmpty('note');

        $validator
                ->allowEmpty('data');

        return $validator;
    }

    public function addRecord($title, $action_type, $row_count, $note, $data) {
        $autoAction = $this->newEntity();
        $autoAction->title = $title;
        $autoAction->row_count = $row_count;
        $autoAction->action_type = $action_type;
        $autoAction->note = $note;
        $autoAction->data = $data;
        return $this->save($autoAction);
    }

}
