
<?php

if (isset($navmenu) && $this->Permission->isLoggedIn()) {
    $this->Menu->getNavMenu($navmenu);
}
?>
