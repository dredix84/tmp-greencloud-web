<?php
namespace MenuManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity.
 *
 * @property int $id
 * @property string $title
 * @property int $menu_id
 * @property string $before_title
 * @property string $after_title
 * @property string $url
 * @property string $controller
 * @property string $action
 * @property string $permissions
 * @property string $link_params
 * @property string $active_link_actions
 * @property \MenuManager\Model\Entity\Menu[] $menus
 */
class Menu extends Entity
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
