<?php
$receiptPath = \Cake\Core\Configure::read('receipts_file_path');
?>

<div class="receipts view large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title">
                        <?= __('Receipt #') . h($receipt->receipt_number) ?> (<?= h($receipt->receipt_date) ?>)
                    </h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">

                        <tr>
                            <th><?= __('Receipt Number') ?></th>
                            <td><?= h($receipt->receipt_number) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Merchant') ?></th>
                            <td><?= $receipt->has('merchant') ? $receipt->merchant->business_title : '' ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Receipt Date') ?></th>
                            <td><?= h($receipt->receipt_date) ?></td>
                        </tr>

                        <?php if ($receipt->has('provider')): ?>
                            <tr>
                                <th><?= __('Provider') ?></th>
                                <td><?= $receipt->has('provider') ? $receipt->provider->name : '' ?></td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?= __('Terminal') ?></th>
                            <td><?= h($receipt->terminal) ?></td>
                        </tr>

                        <?php if ($this->Permission->hasPermission('users.view')) { ?>
                            <tr>
                                <th><?= __('User') ?></th>
                                <td>
                                    <?= $receipt->has('user') ? $this->Html->link($receipt->user->username,
                                        ['controller' => 'Users', 'action' => 'view', $receipt->user->id]) : '' ?>
                                </td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($receipt->claim_number)) { ?>
                            <tr>
                                <th><?= __('Claim Number') ?></th>
                                <td><?= h($receipt->claim_number) ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($receipt->policy_number)) { ?>
                            <tr>
                                <th><?= __('Policy Number') ?></th>
                                <td><?= h($receipt->policy_number) ?></td>
                            </tr>
                        <?php } ?>

                        <?php if (!empty($receipt->authorize_number)) { ?>
                            <tr>
                                <th><?= __('Authorize Number') ?></th>
                                <td><?= h($receipt->authorize_number) ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <th><?= __('Payment Type') ?></th>
                            <td><?= $receipt->has('payment_type') ? $receipt->payment_type->title : '' ?></td>
                        </tr>

                        <?php if ($receipt->has('provider') && $this->Permission->inRole(1, 0)): ?>
                            <tr>
                                <th><?= __('My Note') ?></th>
                                <td><?= $this->Text->autoParagraph($receipt->user_note) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($receipt->has('discount_type')): ?>
                            <tr>
                                <th><?= __('Discount') ?></th>
                                <td><?= h($receipt->discount_type) ?> <?= $this->Number->format($receipt->discount) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($receipt->has('subtotal')): ?>
                            <tr>
                                <th><?= __('Subtotal') ?></th>
                                <td><?= __('$') ?><?= $this->Number->format($receipt->subtotal) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($receipt->has('tax')): ?>
                            <tr>
                                <th><?= __('Tax') ?></th>
                                <td><?= __('$') ?><?= $this->Number->format($receipt->tax) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($receipt->has('total')): ?>
                            <tr>
                                <th><?= __('Total') ?></th>
                                <td><?= __('$') ?><?= $this->Number->format($receipt->total) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($receipt->has('credits_used') && $this->Permission->hasPermission('receipts.viewcreditsused')): ?>
                            <tr>
                                <th><?= __('Credits Used') ?></th>
                                <td><?= $this->Number->format($receipt->credits_used) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($receipt->has('loyalty_cost')): ?>
                            <tr>
                                <th><?= __('Loyalty') ?></th>
                                <td><?= __('$') ?><?= $this->Number->format($receipt->loyalty_cost) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($receipt->has('note')): ?>
                            <tr>
                                <th><?= __('Note') ?></th>
                                <td><?= $receipt->note ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>

                </div>
            </section>
        </div>

        <div class="col-md-12">
            <?php
            if (file_exists($receiptPath . $receipt->id . '.pdf')) {
                echo $this->Html->link(__('View Receipt'),
                    ['action' => 'preview_receipt', $receipt->id, $receipt->security_key . '.pdf'], [
                        'escape' => false,
                        'target' => '_blank',
                        'class' => 'modalbox_ btn-xl btn-primary btn-block btn-lg'
                    ]);
            }
            ?>
        </div>
        <br/>

        <?php if (true  || ($this->Permission->isAdmin() && $receipt->has('receipt_text_data'))): ?>
            <div class="col-md-12">
                <section class="panel panel-success">
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>

                        <h2 class="panel-title"><?= __('Receipt') ?></h2>
                    </header>
                    <div class="panel-body receiptTextPreview">
                        <pre><?= h($receipt->receipt_text_data) ?></pre>
                    </div>
                </section>
            </div>
        <?php endif; ?>
    </div>


    <?php if (!empty($receipt->receipt_items)): ?>
        <div class="related">

            <div>
                <div class="col-md-12">
                    <section class="panel panel-info">
                        <header class="panel-heading">
                            <div class="panel-actions">
                            </div>

                            <h2 class="panel-title"><?= __('Related Receipt Items') ?></h2>
                        </header>
                        <div class="panel-body">

                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <th><?= __('Sku') ?></th>
                                    <th><?= __('Description') ?></th>
                                    <th><?= __('Quantity') ?></th>
                                    <th><?= __('Weight') ?></th>
                                    <th><?= __('Unit Price') ?></th>
                                    <th><?= __('Total') ?></th>
                                </tr>
                                <?php foreach ($receipt->receipt_items as $receiptItems): ?>
                                    <tr>
                                        <td><?= h($receiptItems->sku) ?></td>
                                        <td><?= h($receiptItems->description) ?></td>
                                        <td><?= h($receiptItems->quantity) ?></td>
                                        <td><?= h($receiptItems->weight) ?></td>
                                        <td><?= h($receiptItems->unit_price) ?></td>
                                        <td><?= h($receiptItems->total) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
