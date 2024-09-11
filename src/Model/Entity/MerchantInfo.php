<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MerchantInfo Entity.
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
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property string $parish_state
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property float $print_cost
 * @property string $username
 * @property string $password
 * @property bool $is_active
 * @property bool $is_locked
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $created_by
 * @property int $modified_by
 * @property bool $deleted
 * @property \Cake\I18n\Time $date_deleted
 * @property int $deleted_by
 * @property string $deactivate_note
 * @property int $low_credit_alert_amount
 * @property bool $send_low_credit_email
 * @property int $receipt_count
 * @property float $credits_used
 * @property float $credits_purchased
 */
class MerchantInfo extends Entity
{

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _getBusinessTitle() {
        $address = [
            h($this->_properties['city']),
            //h($this->_properties['parish_state'])
        ];
        return $this->_properties['name'] . ' - ' . implode(', ', $address);
    }

    protected function _getCreditsRemaining() {
        return $this->_properties['credits_purchased']  - $this->_properties['credits_used'];
    }
}
