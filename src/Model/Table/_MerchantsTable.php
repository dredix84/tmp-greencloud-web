<?php
namespace App\Model\Table;

use App\Model\Entity\Merchant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Merchants Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Industries
 * @property \Cake\ORM\Association\HasMany $Activeusers
 * @property \Cake\ORM\Association\HasMany $Locations
 * @property \Cake\ORM\Association\HasMany $MerchantUsers
 * @property \Cake\ORM\Association\HasMany $Receipts
 * @property \Cake\ORM\Association\HasMany $Users
 */
class MerchantsTable extends Table
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

        $this->table('merchants');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Industries', [
            'foreignKey' => 'industry_id'
        ]);
        $this->hasMany('Activeusers', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Locations', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('MerchantUsers', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Receipts', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'merchant_id'
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
            ->add('print_cost', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('print_cost');

        $validator
            ->allowEmpty('username');

        $validator
            ->allowEmpty('password');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_active');

        $validator
            ->add('is_locked', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('is_locked');

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
        return $rules;
    }
    
    public function checkAccess($user, $pass){
        $m = $this->find('all', [
            'conditions' => [
                'username' => $user,
                'password' => $pass,
            ]
        ])->first();
        
        if($m->id > 0){
            $m->authorized = 1;
            $m->msg = "Acount is active";
        }else{
            $m = new \stdClass();
            $m->authorized = 0;
            $m->msg = "Invalid username and password";
        }
        return $m;
    }
}
