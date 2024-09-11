<?php
use \Cake\Core\Configure;
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

Hello <?= $name ?>,

You have a new e-Receipt from <?=$merchant_name?>.


Please click the link below to log into your account in order to view this and other receipts you received using Green Cloud E-Receipts.
<?=WEBROOT?>
<?= $content ?>

For more information, please visit our website at https://www.variantsol.com/greencloud or call our customer service at (876) 482-6544