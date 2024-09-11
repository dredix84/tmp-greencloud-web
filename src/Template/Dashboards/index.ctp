<?php

use Cake\View\Helper\UrlHelper;

$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$user = &$userinfo;
$webroot = $this->Url->build('/', true);
?>


<style>
    .content-body .panel .fa.fafix{
        margin-top: 25px;
    }
</style>

<div class="row">

    <?php echo $this->element('Dashboards/dash_role' . $user['role_id']); ?>

</div>