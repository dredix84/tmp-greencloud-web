<?php

use Cake\Core\Configure;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title><?= $this->fetch('title') ?></title>
    </head>
    <body>
        <div style="border: 1px solid #548DA9; max-width: 800px; margin-left: auto; margin-right: auto">
            <div style="padding: 5px; background-color: #CAD9DF">
                <table>
                    <tr>
                        <td><img src="<?= WEBROOT ?><?= Configure::read('logo_small') ?>"> </td>
                        <td valign="middle"> <h1><?= Configure::read('app_name') ?></h1></td>
                    </tr>
                </table>

            </div>

            <div style="padding: 5px">
<?= $this->fetch('content') ?>
            </div>

            <div style="padding: 5px; background-color: #CAD9DF; font-weight: bold">
                <a href="<?= WEBROOT ?>" target="_blank"><?= Configure::read('app_name') ?></a>
            </div>
        </div>
    </body>
</html>
