<?php
namespace App\Model\Table;

use App\Model\Entity\ParentMenu;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParentMenus Model
 *
 * @property \Cake\ORM\Association\HasMany $Menus
 */
class ParentMenusTable extends Table
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

        $this->table('parent_menus');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('Menus', [
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
            ->requirePresence('id', 'create')
            ->notEmpty('id');

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
}
