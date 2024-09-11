<?php
use \Cake\Core\Configure;

$webroot = &$this->request->webroot;
?>

<p>Hello <?= $name ?>,</p>
<p>Thank you for registering with <a href="<?= $webroot ?>" target="_blank"><?= Configure::read('app_name') ?></a>.
    <br />Before you can start using your account, you will be required to activate the account first.
</p>
<?=$this->Text->autoParagraph($this->Text->autoLinkUrls($content)); ?>
<p>Please <a href="<?=$aurl?>">click here</a> or use the link below to activate your account.
    <br /><a href="<?=$aurl?>"><?=$aurl?></a>
</p>
