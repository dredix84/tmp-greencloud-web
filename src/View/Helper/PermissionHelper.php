<?php

namespace App\View\Helper;

require_once(ROOT . DS . 'vendor' . DS  . 'Dredix' . DS . 'Security' . DS . 'Permissions.php');

use Cake\View\Helper;

class PermissionHelper extends Helper {
    use \Permissions;
}
