<div class="smsLogs view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($smsLog->id) ?></h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">
                        <tr>
                            <th><?= __('Receipt') ?></th>
                            <td>
                                <?= $smsLog->has('receipt') ? $this->Html->link($smsLog->receipt->receipt_number,
                                    ['controller' => 'Receipts', 'action' => 'view', $smsLog->receipt->id]) : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Merchant') ?></th>
                            <td><?= $smsLog->has('merchant') ? $this->Html->link($smsLog->merchant->name, [
                                    'controller' => 'Merchants',
                                    'action' => 'view',
                                    $smsLog->merchant->id
                                ]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Sms Type') ?></th>
                            <td><?= ucfirst($smsLog->sms_type) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Phone Number') ?></th>
                            <td><?= h($smsLog->phone_number) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Send Via') ?></th>
                            <td><?= h($smsLog->send_via) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Currency') ?></th>
                            <td><?= h($smsLog->currency) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($smsLog->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Cost') ?></th>
                            <td><?= $this->Number->format($smsLog->cost) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Rate') ?></th>
                            <td><?= $this->Number->format($smsLog->rate) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Exchange Rate') ?></th>
                            <td><?= $this->Number->format($smsLog->exchange_rate) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Sent') ?></th>
                            <td><?= h($smsLog->sent) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($smsLog->created) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Errored') ?></th>
                            <td><?= $smsLog->errored ? __('Yes') : __('No'); ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Message') ?></th>
                            <td><?= $this->Text->autoLink($smsLog->message); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Gateway Response') ?></th>
                            <td><?= $this->Text->autoParagraph(h($smsLog->gateway_response)); ?></td>
                        </tr>
                    </table>

                </div>
            </section>
        </div>
    </div>


</div>
