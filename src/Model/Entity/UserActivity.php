<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserActivity Entity.
 *
 * @property int $id
 * @property string $created
 * @property string $controller
 * @property string $action
 * @property string $after_action
 * @property string $ip_address
 * @property string $title
 * @property string $note
 * @property int $risk
 * @property string $other_data
 * @property int $flag
 */
class UserActivity extends Entity
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
