<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($menu['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>

<?php echo $this->element('Receipts/index_role' . $userinfo['role_id']); 