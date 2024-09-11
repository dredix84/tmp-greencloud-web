<?php
use \Cake\Core\Configure;
$app_name = Configure::read('app_name');
?>

<p>Hello <?= $name ?>,</p>
<p>A password reset request was made at <a href="<?= WEBROOT ?>" target="_blank"><?= $app_name?></a>.<br />
Please see your new password below.<br /><br />
Password: <?=$password?>
</p>
<?=$this->Text->autoParagraph($this->Text->autoLinkUrls($content)); ?>