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
$app_name = Configure::read('app_name');
?>

Hello <?= $name ?>,

A password reset request was made at <?= $app_name?>.
Please click on the link below to reset your password. If you did not request to have your password changed, then ignore this email.

<?= $content ?>
Click here to reset your <?=$app_name?> password.
<?=$aurl?>