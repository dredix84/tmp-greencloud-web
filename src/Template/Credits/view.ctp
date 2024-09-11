

<div class="credits view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($credit->id) ?></h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">
                        <tr>
                            <th><?= __('Merchant') ?></th>
                            <td><?= $credit->has('merchant') ? $this->Html->link($credit->merchant->name, ['controller' => 'Merchants', 'action' => 'view', $credit->merchant->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Payment') ?></th>
                            <td><?= $credit->has('payment') ? $this->Html->link($credit->payment->id, ['controller' => 'Payments', 'action' => 'view', $credit->payment->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($credit->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Credit Amount') ?></th>
                            <td><?= $this->Number->format($credit->credit_amount) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Added By') ?></th>
                            <td><?= $this->Number->format($credit->added_by) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($credit->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($credit->modified) ?></td>
                        </tr>


                        <tr>
                            <th><?= __('Note') ?></th>
                            <td><?= $this->Text->autoParagraph(h($credit->note)); ?></td>
                        </tr>
                    </table>

                </div>
            </section>
        </div>

        <?php if ($credit->has('payment')) { ?>
            <div class="col-md-12">
                <section class="panel panel-success">
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>

                        <h2 class="panel-title"><i class="fa fa-money"></i> <?= __('Payment') ?>: <?= $credit->payment->payment_transaction_id ?></h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed mb-none">
                                <tr>
                                    <th><?= __('Payment Type') ?></th>
                                    <td><?= $credit->payment->payment_type ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Transaction ID') ?></th>
                                    <td><?= $credit->payment->payment_transaction_id ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Payment') ?></th>
                                    <td>$<?= $credit->payment->total ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Note') ?></th>
                                    <td><?= $this->Text->autoParagraph($credit->payment->note) ?></td>
                                </tr>


                            </table>
                        </div>
                    </div>
                </section>
            </div>
        <?php } ?>

    </div>                    




</div>
