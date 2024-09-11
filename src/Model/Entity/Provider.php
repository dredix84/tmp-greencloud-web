<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Provider Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $description
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
 * @property string $finder_words
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\User[] $users
 */
class Provider extends Entity
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
