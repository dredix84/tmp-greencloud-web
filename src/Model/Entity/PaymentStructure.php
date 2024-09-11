<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaymentStructure Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property float $cost_per_receipt
 * @property float $percent_per_receipt
 * @property float $cost_per_sms
 * @property string $currency
 * @property bool $is_active
 * @property bool $is_default
 * @property \Cake\I18n\Time $expiry_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $created_by
 * @property int $modified_by
 * @property \App\Model\Entity\Merchant[] $merchants
 */
class PaymentStructure extends Entity
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
