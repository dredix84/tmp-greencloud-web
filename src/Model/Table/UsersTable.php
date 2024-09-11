<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use App\Model\Traits\TableCommon;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $Merchants
 * @property \Cake\ORM\Association\BelongsTo $Providers
 * @property \Cake\ORM\Association\HasMany $Receipts
 */
class UsersTable extends Table {

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

        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id'
        ]);
        $this->belongsTo('Merchants', [
            'foreignKey' => 'merchant_id'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('Providers', [
            'foreignKey' => 'provider_id'
        ]);
        $this->hasMany('Receipts', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('MerchantAccounts', [
            'className' => 'MerchantInfo',
            'foreignKey' => 'created_by'
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
                ->requirePresence('username', 'create')
                ->notEmpty('username');

        $validator
                ->requirePresence('password', 'create')
                ->notEmpty('password');
        $validator->add('password', 'length', ['rule' => ['lengthBetween', 6, 100]]);

        $validator
                ->add('confirm_password', 'compareWith', [
                    'rule' => ['compareWith', 'password'],
                    'message' => 'Passwords not equal.'
        ]);
        $validator
                ->notEmpty('new_password')
                ->notEmpty('confirm_new_password')
                ->notEmpty('current_password');
        $validator->add('new_password', 'length', ['rule' => ['lengthBetween', 6, 100]]);

        $validator
                ->add('email', 'valid', ['rule' => 'email'])
                ->requirePresence('email', 'create')
                ->notEmpty('email');

        $validator
                ->notEmpty('first_name');

        $validator
                ->allowEmpty('last_name');

        $validator
                ->notEmpty('phone');
        $validator
                ->add('phone', [
                    'minLength' => [
                        'rule' => ['minLength', 10],
                        'last' => true,
                        'message' => 'Phone number must be 10 characters long. If you have a 1 in front of the area code, remove the 1.'
                    ],
                    'maxLength' => [
                        'rule' => ['maxLength', 15],
                        'message' => 'Phone number must be 10 characters long. If you have a 1 in front of the area code, remove the 1.'
                    ]
        ]);

        $validator
                ->add('last_login', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('last_login');

        $validator
                ->add('is_active', 'valid', ['rule' => 'boolean'])
                ->allowEmpty('is_active');

        $validator
                ->add('is_locked', 'valid', ['rule' => 'boolean'])
                ->allowEmpty('is_locked');

        $validator
                ->add('activated', 'valid', ['rule' => 'boolean'])
                ->allowEmpty('activated');

        $validator
                ->allowEmpty('activation_code');

        $validator
                ->notEmpty('agreeterms');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        //$rules->add($rules->existsIn(['merchant_id'], 'Merchants'));
        //$rules->add($rules->existsIn(['provider_id'], 'Providers'));
        return $rules;
    }

    /**
     * Used by the Auth component. This modifies the query used to find authenicated users
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findAuth(\Cake\ORM\Query $query, array $options) {
        $query
                ->select()
                ->where(['Users.is_active' => 1])
                ->contain(['Roles', 'Merchants', 'Providers', 'Countries']);

        return $query;
    }

    public function getTranactionUser($requestData) {
        $customerConditions = [];
        if (!empty($requestData['customer_phone']) && !empty($requestData['customer_email'])) {
            $customerConditions['OR']['phone'] = $requestData['customer_phone'];
            $customerConditions['OR']['email'] = filter_input(INPUT_POST, 'customer_email');
        } elseif (!empty($requestData['customer_phone'])) {
            $customerConditions['phone'] = $requestData['customer_phone'];
        } elseif (!empty($requestData['customer_email'])) {
            $customerConditions['email'] = $requestData['customer_email'];
        }

        $userDB = $this->find('all', [
            'conditions' => $customerConditions
        ]);
        $user = $userDB->first();


        if (empty($user)) {
            $user = $this->newEntity();

            $userData = [
                'username' => 'user_' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10),
                'password' => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 13),
                'first_name' => 'User',
                'role_id' => 1,
                'agreeterms' => 0,
                'user_registered' => 0
            ];
            if (!empty($_REQUEST['customer_email'])) {
                $userData['email'] = $_REQUEST['customer_email'];
            }
            if (!empty($_REQUEST['customer_phone'])) {
                $userData['phone'] = $_REQUEST['customer_phone'];
                $user->phone = $_REQUEST['customer_phone'];
            }

//            if (!empty($_REQUEST['customer_email'])) {
//                $user->phone = $_REQUEST['customer_phone'];
//                $userData['phone'] = $_REQUEST['customer_phone'];
//            }

            $user = $this->patchEntity($user, $userData, ['validate' => false]);
            if ($this->save($user)) {
                //@TODO: Log that user was registered
            }

            $user['new_account'] = true;
        } else {
            $user['new_account'] = false;
        }


        return $user;
    }

    public function getRoleIds() {
        //TODO: This should be cached ot stored in SESSION
        return $this->Roles->find('list')->toArray();
    }

    public function cleanPhone($phone) {
        return str_replace(['(', ')', '-', '_', ' ', '+'], '', $phone);   //Removing unwanted character from phone number
    }

	/**
	 * Used to get a user account which match the phone number or email address
	 * @param string $phone   Used phone number
	 * @param string $email   User email address
	 * @return array|\Cake\Datasource\EntityInterface|null
	 */
    public function getUserByPhoneOrEmail($phone, $email) {
        $user = $this->find('all', [
                    'conditions' => [
                        'OR' => [
                            'phone' => $this->cleanPhone($phone),
                            'email' => $email
                        ],
                    //'user_registered' => 0
                    ],
                    'contain' => []
                ])->first();
        return $user ? $user : $this->newEntity();
    }

    /**
     * Used to return a hashed representation of a string. Same has used for passwords
     * @param string $password
     * @return type
     */
    public function hashString($password) {
        $hasher = new \Cake\Auth\DefaultPasswordHasher();
        return $hasher->hash($password);
    }

    /**
     * Used to deteremine if anoter user has the same telephone number
     * @param type $userid  User ID of user to exclude from check
     * @param type $phonenumber Telephone number to check
     * @return array
     */
    public function numberExist($userid, $phonenumber) {
        $user = $this->find('all', [
                    'conditions' => [
                        'id !=' => $userid,
                        'phone' => $phonenumber
                    ],
                ])->first();
        return $user;
    }

    /**
     * Return list of role and the count of users associated with each role
     * @return type
     */
    public function getRoleUserCount(){
        $conn = $this->getConnection();
        $baseSQL = "SELECT roles.title, Count(users.id) AS user_count 
FROM users
INNER JOIN roles ON users.role_id = roles.id
GROUP BY roles.title";
        $result = $conn->execute($baseSQL, [])->fetchAll('assoc');
        return $result;
    }

    public function getRegisteredVsUnregisteredUser(){
        $conn = $this->getConnection();
        $baseSQL = "SELECT users.user_registered, Count(users.user_registered) AS user_count
FROM users
GROUP BY users.user_registered";
        $result = $conn->execute($baseSQL, [])->fetchAll('assoc');
        return $result;
    }

}
