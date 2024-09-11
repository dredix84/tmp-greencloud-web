<?php
use \Cake\Core\Configure;
$app_name = Configure::read('app_name');
?>

<p>Hello <?= $name ?>,</p>
<p>A password reset request was made at <a href="<?= WEBROOT ?>" target="_blank"><?= $app_name?></a>.
<br />Please click on the link below to reset your password. If you did not request to have your password changed, then ignore this email.
</p>
<?=$this->Text->autoParagraph($this->Text->autoLinkUrls($content)); ?>
<p><a href="<?=$aurl?>">Click here to reset your <?=$app_name?> password</a>.
<br /><a href="<?=$aurl?>"><?=$aurl?></a>
</p>