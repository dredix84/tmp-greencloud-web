<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Credit Entity.
 *
 * @property int $id
 * @property int $merchant_id
 * @property \App\Model\Entity\Merchant $merchant
 * @property int $payment_id
 * @property \App\Model\Entity\Payment $payment
 * @property int $credit_amount
 * @property string $note
 * @property int $added_by
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Credit extends Entity
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
