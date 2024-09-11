<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invoice Entity.
 *
 * @property int $id
 * @property string $invoice_number
 * @property \Cake\I18n\Time $invoice_date
 * @property \Cake\I18n\Time $due_date
 * @property int $invoice_status_id
 * @property \App\Model\Entity\InvoiceStatus $invoice_status
 * @property int $merchant_id
 * @property \App\Model\Entity\Merchant $merchant
 * @property int $to_merchant_id
 * @property \App\Model\Entity\ToMerchant $to_merchant
 * @property string $from_address
 * @property string $to_address
 * @property float $shipping
 * @property int $discount_type
 * @property float $discount
 * @property float $sub_total
 * @property float $grand_total
 * @property bool $paid
 * @property string $note
 * @property string $private_note
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $created_by
 * @property int $modified_by
 */
class Invoice extends Entity
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
