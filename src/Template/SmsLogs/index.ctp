<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];
?>
<div class="smsLogs index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Sms Logs') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create(null, ['type' => 'get']) ?>
                    <div class="col-md-6">
                        <div class="input-group mb-md">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="search" name="search_term" id="search_term"
                                   placeholder="<?= __('Enter your search term...') ?>" class="form-control">
                        </div>
                    </div>

                    <?php

                    echo $this->Form->button(__('Preform Search'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->input('a', ['type' => 'hidden', 'value' => 'search']);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>


            <section class="panel panel-primary panel-data">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Sms Logs') ?>
                        <small>(<?= $count ?> <?= $count == 1 ? __('Record found') : __('Records found') ?> )</small>
                    </h2>
                </header>
                <div class="panel-body">
                    <div class="_table-responsive">

                        <table cellpadding="0" cellspacing="0"
                               class="table table-bordered table-striped table-hover mb-none">
                            <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('receipt_id') ?></th>
                                <th><?= $this->Paginator->sort('merchant_id') ?></th>
                                <th><?= $this->Paginator->sort('sms_type') ?></th>
                                <th><?= $this->Paginator->sort('phone_number') ?></th>
                                <th><?= $this->Paginator->sort('sent') ?></th>
                                <th><?= $this->Paginator->sort('send_via') ?></th>
                                <th><?= $this->Paginator->sort('errored') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($smsLogs as $smsLog): ?>
                                <tr>
                                    <td><?= $smsLog->has('receipt') ? $this->Html->link($smsLog->receipt->receipt_number, [
                                            'controller' => 'Receipts',
                                            'action' => 'view',
                                            $smsLog->receipt->id
                                        ]) : '' ?></td>
                                    <td><?= $smsLog->has('merchant') ? $this->Html->link($smsLog->merchant->name, [
                                            'controller' => 'Merchants',
                                            'action' => 'view',
                                            $smsLog->merchant->id
                                        ]) : '' ?></td>
                                    <td><?= h($smsLog->sms_type) ?></td>
                                    <td><?= h($smsLog->phone_number) ?></td>
                                    <td><?= h($smsLog->sent) ?></td>
                                    <td><?= h($smsLog->send_via) ?></td>
                                    <td><?= $smsLog->errored ? __('Yes') : __('No'); ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $smsLog->id],
                                            [
                                                'escape' => false,
                                                'class' => 'modalbox btn btn-primary btn-sm',
                                                'data-ajaxlink' => '#modalbox'
                                            ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>


    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev(__('previous'), ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next'), ['escape' => false]) ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
