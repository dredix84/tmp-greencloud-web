<?php

use \Cake\Core\Configure;
use Cake\Routing\Router;

$webroot = &$this->request->webroot;
?>

<p>Hello <em><?= $name ?></em>,</p>
<p>You have a new e-Receipt from <strong><em><?= $merchant_name ?></em></strong>.</p>


<hr/>
<?php
$summInfo = [
    'Doctor' => 'doctor',
    'Receipt #' => 'receipt_number',
    'Receipt Date' => 'receipt_date',
    'Receipt Total' => 'total',
    'Receipt Sub-Total' => 'subtotal',
    'Coverage Paid' => 'coverage_paid',
    'Balance' => 'balance',
    'Tax' => 'tax',
];
$moneyVal = ['tax', 'balance', 'coverage_paid', 'total', 'subtotal'];
?>
<h2>Receipt Summary</h2>
<table>
    <?php
    foreach ($summInfo as $sTitle => $sVal) {
        if (!empty($receipt->{$sVal})) {
            ?>
            <tr>
                <th style="text-align: left"><?= __($sTitle) ?></th>
                <td>
                    <?php
                    if (in_array($sVal, $moneyVal)) {
                        echo '$';
                    }
                    echo $receipt->{$sVal}
                    ?>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>
<hr/>
<a target="_blank" href="<?= Router::url(['controller' => 'r', $receipt->id], true) ?>" class="btn-success">View Receipt Online</a>
<hr/>
<pre style="background-color: rgb(252, 252, 252); padding: 15px;"><?= $receipt->receipt_text_data ?></pre>
<hr/>

<p>Please click here to log into your account in order to view this and other receipts you receive using Green Cloud
    E-Receipts.</p>
<p><a href="<?= WEBROOT ?>">Click here</a> to view your new e-Receipt.</p>
<?= $this->Text->autoParagraph($this->Text->autoLinkUrls($content)); ?>


<p>For more information, please visit our website at <a href="https://www.variantsol.com/greencloud" target="_blank">https://www.variantsol.com/greencloud</a>
    or call our customer service at (876) 482-6544</p>
