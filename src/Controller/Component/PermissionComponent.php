<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller\Component;

require_once(ROOT . DS . 'vendor' . DS  . 'Dredix' . DS . 'Security' . DS . 'Permissions.php');

use Cake\Controller\Component;

/**
 * Description of PermissonComponent
 *
 * @author Andre
 */
class PermissionComponent extends Component
{
    use \Permissions;
}
