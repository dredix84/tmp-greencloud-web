<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $permissions
 * @property \Cake\I18n\Time $created
 * @property string $modified
 * @property int $created_by
 * @property int $modified_by
 * @property \App\Model\Entity\Activeuser[] $activeusers
 * @property \App\Model\Entity\Menu[] $menus
 * @property \App\Model\Entity\ParentMenu[] $parent_menus
 * @property \App\Model\Entity\User[] $users
 */
class Role extends Entity
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
    
    protected function _setPermissions($permissions) {
        return json_encode($permissions);
    }
}
