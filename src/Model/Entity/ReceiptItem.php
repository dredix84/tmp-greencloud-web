<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReceiptItem Entity.
 *
 * @property int $id
 * @property int $receipt_id
 * @property \App\Model\Entity\Receipt $receipt
 * @property string $sku
 * @property string $description
 * @property float $quantity
 * @property float $weight
 * @property float $unit_price
 * @property float $total
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ReceiptItem extends Entity
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
