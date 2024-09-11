

<div class="payments view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($payment->id) ?></h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="vertical-table table table-hover">
                            <tr>
                                <th><?= __('Merchant') ?></th>
                                <td><?= $payment->has('merchant') ? $this->Html->link($payment->merchant->name, ['controller' => 'Merchants', 'action' => 'view', $payment->merchant->id]) : '' ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Code') ?></th>
                                <td><?= h($payment->code) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Session Id') ?></th>
                                <td><?= h($payment->session_id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Paypal Token') ?></th>
                                <td><?= h($payment->paypal_token) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Billing Name') ?></th>
                                <td><?= h($payment->billing_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Billing Street') ?></th>
                                <td><?= h($payment->billing_street) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Billing City') ?></th>
                                <td><?= h($payment->billing_city) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Billing State') ?></th>
                                <td><?= h($payment->billing_state) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Billing Zip') ?></th>
                                <td><?= h($payment->billing_zip) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Billing Country') ?></th>
                                <td><?= h($payment->billing_country) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Billing Phone') ?></th>
                                <td><?= h($payment->billing_phone) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Payment Type') ?></th>
                                <td><?= h($payment->payment_type) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Cardtype') ?></th>
                                <td><?= h($payment->cardtype) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Accountnumber') ?></th>
                                <td><?= h($payment->accountnumber) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Status') ?></th>
                                <td><?= h($payment->status) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Gateway') ?></th>
                                <td><?= h($payment->gateway) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Gateway Environment') ?></th>
                                <td><?= h($payment->gateway_environment) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Payment Transaction Id') ?></th>
                                <td><?= h($payment->payment_transaction_id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Subscription Transaction Id') ?></th>
                                <td><?= h($payment->subscription_transaction_id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <td><?= $this->Number->format($payment->id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Subtotal') ?></th>
                                <td><?= $this->Number->format($payment->subtotal) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Tax') ?></th>
                                <td><?= $this->Number->format($payment->tax) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Couponamount') ?></th>
                                <td><?= $this->Number->format($payment->couponamount) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Certificate Id') ?></th>
                                <td><?= $this->Number->format($payment->certificate_id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Certificateamount') ?></th>
                                <td><?= $this->Number->format($payment->certificateamount) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Total') ?></th>
                                <td><?= $this->Number->format($payment->total) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Expirationmonth') ?></th>
                                <td><?= $this->Number->format($payment->expirationmonth) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Expirationyear') ?></th>
                                <td><?= $this->Number->format($payment->expirationyear) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created By') ?></th>
                                <td><?= $this->Number->format($payment->created_by) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Modified By') ?></th>
                                <td><?= $this->Number->format($payment->modified_by) ?></td>
                            </tr>

                            <tr>
                                <th><?= __('Created') ?></th>
                                <td><?= h($payment->created) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Modified') ?></th>
                                <td><?= h($payment->modified) ?></td>
                            </tr>


                            <tr>
                                <th><?= __('Note') ?></th>
                                <td><?= $this->Text->autoParagraph(h($payment->note)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>                    




    <div class="related">

        <div>
            <div class="col-md-12">
                <section class="panel panel-info">
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>

                        <h2 class="panel-title"><?= __('Related Credits') ?></h2>
                    </header>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <?php if (!empty($payment->credits)): ?>
                                <table class="table table-bordered table-condensed">
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('Credit Amount') ?></th>
                                        <th><?= __('Note') ?></th>
                                        <th><?= __('Added By') ?></th>
                                        <th><?= __('Created') ?></th>
                                        <th><?= __('Modified') ?></th>
                                        <th><?= __('Created By') ?></th>
                                        <th><?= __('Modified By') ?></th>
                                    </tr>
                                    <?php foreach ($payment->credits as $credits): ?>
                                        <tr>
                                            <td><?= h($credits->id) ?></td>
                                            <td><?= h($credits->credit_amount) ?></td>
                                            <td><?= h($credits->note) ?></td>
                                            <td><?= h($credits->added_by) ?></td>
                                            <td><?= h($credits->created) ?></td>
                                            <td><?= h($credits->modified) ?></td>
                                            <td><?= h($credits->created_by) ?></td>
                                            <td><?= h($credits->modified_by) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>                    



    </div>
</div>
