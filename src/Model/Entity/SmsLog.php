<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SmsLog Entity.
 *
 * @property int $id
 * @property int $receipt_id
 * @property int $merchant_id
 * @property string $sms_type
 * @property string $phone_number
 * @property string $message
 * @property \Cake\I18n\Date $sent
 * @property string $send_via
 * @property bool $errored
 * @property float $cost
 * @property float $rate
 * @property string $currency
 * @property float $exchange_rate
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $gateway_response
 */
class SmsLog extends Entity
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
