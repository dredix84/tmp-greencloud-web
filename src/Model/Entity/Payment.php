<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity.
 *
 * @property int $id
 * @property int $merchant_id
 * @property \App\Model\Entity\Merchant $merchant
 * @property string $code
 * @property string $session_id
 * @property string $paypal_token
 * @property string $billing_name
 * @property string $billing_street
 * @property string $billing_city
 * @property string $billing_state
 * @property string $billing_zip
 * @property string $billing_country
 * @property string $billing_phone
 * @property float $subtotal
 * @property float $tax
 * @property float $couponamount
 * @property int $certificate_id
 * @property float $certificateamount
 * @property float $total
 * @property string $payment_type
 * @property string $cardtype
 * @property string $accountnumber
 * @property int $expirationmonth
 * @property int $expirationyear
 * @property string $status
 * @property string $gateway
 * @property string $gateway_environment
 * @property string $payment_transaction_id
 * @property string $subscription_transaction_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $note
 * @property int $created_by
 * @property int $modified_by
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Credit[] $credits
 */
class Payment extends Entity
{

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
}
