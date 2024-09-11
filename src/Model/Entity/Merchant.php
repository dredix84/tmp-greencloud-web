<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Merchant Entity.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $industry_id
 * @property \App\Model\Entity\Industry $industry
 * @property int $payment_structure_id
 * @property \App\Model\Entity\PaymentStructure $payment_structure
 * @property int $loyalty_program_id
 * @property \App\Model\Entity\LoyaltyProgram $loyalty_program
 * @property string $about
 * @property string $logo
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $contact_position
 * @property string $contact_email
 * @property string $website
 * @property float $print_cost
 * @property string $username
 * @property string $password
 * @property bool $is_active
 * @property bool $is_locked
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Activeuser[] $activeusers
 * @property \App\Model\Entity\Credit[] $credits
 * @property \App\Model\Entity\Location[] $locations
 * @property \App\Model\Entity\MerchantUser[] $merchant_users
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\Receipt[] $receipts
 * @property \App\Model\Entity\User[] $users
 * @property int $receipt_timeout
 * @property int $feedback_timeout
 * @property bool $send_sms
 * @property string $currency
 *
 * Virtual Fields
 * @property string $business_title
 */
class Merchant extends Entity {

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

    protected $_virtual = ['business_title'];

    protected function _getBusinessTitle() {
        $address = [
            h($this->_properties['city']),
            //h($this->_properties['parish_state'])
        ];
        return $this->_properties['name'] . ' - ' . implode(', ', $address);
    }

    protected function _getActiveStatus() {
        return $this->_properties['is_locked'] == 0 && $this->_properties['is_active'] == 1;
    }


}
