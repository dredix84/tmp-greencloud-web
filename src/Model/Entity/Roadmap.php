<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Roadmap Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $category
 * @property int $status
 * @property string $description
 * @property \Cake\I18n\Time $delivery_date
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $priority
 * @property string $tags
 * @property string $comments
 * @property string $icon
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $created_by
 * @property int $modified_by
 */
class Roadmap extends Entity
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
