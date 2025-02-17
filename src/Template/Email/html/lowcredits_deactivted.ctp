<?php

use \Cake\Core\Configure;

//@TODO: Make this more efficient by placing the operations below in the controller
//$names[] = $merchant->contact_name;
//if ($merchant->contact_name != $merchant->created_by_user->first_name & ' ' & $merchant->created_by_user->last_name) {
//    $names[] = $merchant->created_by_user->first_name & ' ' & $merchant->created_by_user->last_name;
//}

$address = [
    trim($merchant->address_line_1),
    trim($merchant->address_line_2),
    trim($merchant->city),
    trim($merchant->parish_state),
];
array_filter($address);
$appname = Configure::read('app_name');
?>

<style>
    th{
        text-align: left;
    }
    tr.expireDate td, span.expireDate, .overcredits{
        color: red;
    }
    .merchanename{
        font-weight: bold;
    }
    .headline{
        background-image: linear-gradient(to bottom, #f2dede 0px, #e7c3c3 100%);
        background-repeat: repeat-x;
        border-color: #dca7a7;
        border-radius: 4px;
        margin-bottom: 20px;
        margin-top: 10px;
        padding: 15px;
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.25) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
        text-align: center;
        color: red;
    }
    td, th{
        border-bottom: 1px dotted grey;
    }
    table.infoTable{
        width: 100%
    }
</style>
<div class="headline">
    <h1><?= _('Account Deactivated') ?></h1>
</div>
<p>Hello <em><?= implode(' and ', $names) ?></em>,</p>
<p>In reference to the notification email sent to you on <?= $merchant->low_credit_mail_sent_date ?>, we have not seen a  payment made towards your account to date. 
    As a result, your <?= $appname ?> merchant account, <strong><?= $merchant->name ?></strong>, has expired and is no longer able to send receipts using this service. </p>
<p>If you would like to re-activate the account, please contact a <?= $appname ?> representative with the contact details below. If you have received this email in error, kindly ignore.</p>
<p>This is an automated message generated by <?= $appname ?> Electronic Receipts Server.</p>


<table class="infoTable">
    <tbody>
        <tr>
            <th><?= _('Merchant Account:') ?></th>
            <td>
                <span class="merchanename"><?= $merchant->name ?></span><br />
                <?= implode(', ', $address) ?>
            </td>
        </tr>
        <tr>
            <th><?= _('Credits used to date:') ?></th>
            <td><?= $merchant->credits_used ?></td>
        </tr>
    </tbody>
</table>


<h3>Payment Instructions:</h3>
<p>Online Transfer, Direct Deposit, Cheque or Cash to:<br />
    <strong>Immaculate Computers and Equipment, account # 214141353, Oxford Branch</strong>
</p>


<p>If there are any questions, please contact a <a href="<?= WEBROOT ?>"><?= $appname ?></a> representative by email info@variantsol.com or by phone at (876) 482-6544.</p>

<p>This is an automated email generated by the <a href="<?= WEBROOT ?>"><?= $appname ?> system</a>.</p>

<hr />

<p>For more information, please visit our website at <a href="<?= WEBROOT ?>" target="_blank"><?= WEBROOT ?></a> or call our customer service at (876) 482-6544</p>