

<div class="paymentStructures view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($paymentStructure->title) ?></h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">
                        <tr>
                            <th><?= __('Title') ?></th>
                            <td><?= h($paymentStructure->title) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Currency') ?></th>
                            <td><?= h($paymentStructure->currency) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Cost Per Receipt') ?></th>
                            <td><?= $this->Number->format($paymentStructure->cost_per_receipt) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Percent Per Receipt') ?></th>
                            <td><?= $this->Number->format($paymentStructure->percent_per_receipt) ?>%</td>
                        </tr>
                        <tr>
                            <th><?= __('Cost Per SMS') ?></th>
                            <td>$<?= $this->Number->format($paymentStructure->cost_per_sms) ?></td>
                        </tr>
                        <!--tr>
                            <th><?= __('Created By') ?></th>
                            <td><?= $this->Number->format($paymentStructure->created_by) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified By') ?></th>
                            <td><?= $this->Number->format($paymentStructure->modified_by) ?></td>
                        </tr-->

                        <tr>
                            <th><?= __('Expiry Date') ?></th>
                            <td><?= h($paymentStructure->expiry_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= ($paymentStructure->created ? $paymentStructure->created->nice() : '--') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= ($paymentStructure->modified? $paymentStructure->modified->nice(): '--') ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Is Active') ?></th>
                            <td><?= $paymentStructure->is_active ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Default') ?></th>
                            <td><?= $paymentStructure->is_default ? __('Yes') : __('No'); ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Description') ?></th>
                            <td><?= $this->Text->autoParagraph(h($paymentStructure->description)); ?></td>
                        </tr>
                    </table>

                </div>
            </section>
        </div>
    </div>
</div>
