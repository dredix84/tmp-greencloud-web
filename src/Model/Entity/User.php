<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property \Cake\I18n\Time $last_login
 * @property int $role_id
 * @property \App\Model\Entity\Role $role
 * @property int $merchant_id
 * @property int $provider_id
 * @property \App\Model\Entity\Provider $provider
 * @property bool $is_active
 * @property bool $is_locked
 * @property bool $activated
 * @property string $activation_code
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $register_date
 * @property \App\Model\Entity\Receipt[] $receipts
 */
class User extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

    protected function _setPhone($phone) {
        return str_replace(['(', ')', '-','_',' ', '+'], '', $phone);   //Removing unwanted character from phone number
    }
    

    protected function _getFullName() {
        return $this->_properties['first_name'] . ' ' .  $this->_properties['last_name'];
    }
}
