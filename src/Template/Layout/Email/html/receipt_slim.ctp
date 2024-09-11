<?php

use Cake\Core\Configure;

$headColor = '#FFF';
$footerColor = '#9BBF6B';
//gc_logo_2019.png
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?= $this->fetch('title') ?></title>
    <style>
        a.btn-success {
            background-color: #47A447;
            padding: 5px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 7px;
            font-family: monospace;
            font-weight: bold;
            text-decoration: none;
            color: white;
            border: 1px solid #47A447;
        }
    </style>
</head>
<body>
<div style="border: 1px solid #548DA9; max-width: 450px; margin-left: auto; margin-right: auto">
    <div style="padding: 5px; background-color: <?= $headColor ?>">
        <table>
            <tr>
                <td colspan="2" style="color: #ffffff; font-weight: bold">
                    <img style="display: block; margin-left: auto; margin-right: auto; height: 60px"
                         src="<?= WEBROOT ?><?= Configure::read('logo_large') ?>"
                         alt="<?= h(Configure::read('app_name')) ?>">
                </td>
                <th>
                    <h1 style="color: green; font-family: monospace;">Green Cloud eReceipt</h1>
                </th>
            </tr>
        </table>
    </div>

            <div style="padding: 5px">
                <?= $this->fetch('content') ?>
            </div>

    <div style="padding: 5px; background-color: <?= $footerColor ?>; font-weight: bold; color: #ffffff; ">
        <a href="<?= WEBROOT ?>" target="_blank"><?= Configure::read('app_name') ?></a>
    </div>
</div>
</body>
</html>
