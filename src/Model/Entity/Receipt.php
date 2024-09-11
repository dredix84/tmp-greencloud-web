<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Receipt Entity.
 *
 * @property int $id
 * @property int $merchant_id
 * @property \App\Model\Entity\Merchant $merchant
 * @property int $provider_id
 * @property \App\Model\Entity\Provider $provider
 * @property string $terminal
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $receipt_number
 * @property \Cake\I18n\Time $receipt_date
 * @property string $claim_number
 * @property string $discount_type
 * @property float $discount
 * @property float $subtotal
 * @property float $tax
 * @property float $total
 * @property float $credits_used
 * @property float $merchant_receipt_cost
 * @property int $payment_type_id
 * @property \App\Model\Entity\PaymentType $payment_type
 * @property string $user_note
 * @property string $note
 * @property string $receipt_text_data
 * @property string $receipt_file
 * @property bool $should_email
 * @property bool $emailed
 * @property \Cake\I18n\Time $date_emailed
 * @property float $email_cost
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $systen_note
 * @property bool $seen
 * @property bool $send_sms
 * @property \App\Model\Entity\ReceiptItem[] $receipt_items
 */
class Receipt extends Entity
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

    protected function _setSendSms($value)
    {
        return $this->getSetBool($value);
    }

    protected function _setShouldEmail($value)
    {
        return $this->getSetBool($value);
    }


    private function getSetBool($value)
    {
        if (is_bool($value)) {
            return $value;
        } elseif (is_string($value)) {
            return ("true" == strtolower($value) || '1' == $value);
        }
        return false;
    }
}
