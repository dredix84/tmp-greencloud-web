<?php
namespace App\Model\Table;

use App\Model\Entity\Menu;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Menus Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentMenus
 */
class MenusTable extends Table
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

        $this->table('menus');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('ParentMenus', [
            'foreignKey' => 'parent_menu_id'
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
            ->allowEmpty('before_title');

        $validator
            ->allowEmpty('after_title');

        $validator
            ->allowEmpty('url');

        $validator
            ->allowEmpty('controller');

        $validator
            ->allowEmpty('action');

        $validator
            ->allowEmpty('permissions');

        $validator
            ->allowEmpty('link_params');

        $validator
            ->allowEmpty('active_link_actions');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_active');

        $validator
            ->add('super_admin_only', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('super_admin_only');

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
        $rules->add($rules->existsIn(['parent_menu_id'], 'ParentMenus'));
        return $rules;
    }
}
