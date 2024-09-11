<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];
?>
<div class="payments index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Payments') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create(null, ['type' => 'get']) ?>
                    <div class="col-md-6">
                        <div class="input-group mb-md">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="search" name="search_term" id="search_term" placeholder="<?= __('Enter your search term') ?>" class="form-control">
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
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Payments') ?> <small>(<?= $count ?> <?= $count == 1 ? __('Record found') : __('Records found') ?> )</small></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-md">
                                <?= $this->Html->link(__('New Payment <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="_table-responsive">
                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                                <thead>
                                    <tr>
                                        <th><?= $this->Paginator->sort('id') ?></th>
                                        <th><?= $this->Paginator->sort('merchant_id') ?></th>
                                        <th><?= $this->Paginator->sort('code') ?></th>
                                        <th><?= $this->Paginator->sort('session_id') ?></th>
                                        <th><?= $this->Paginator->sort('paypal_token') ?></th>
                                        <th><?= $this->Paginator->sort('billing_name') ?></th>
                                        <th><?= $this->Paginator->sort('billing_street') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $payment): ?>
                                        <tr>
                                            <td><?= $this->Number->format($payment->id) ?></td>
                                            <td><?= $payment->has('merchant') ? $this->Html->link($payment->merchant->name, ['controller' => 'Merchants', 'action' => 'view', $payment->merchant->id]) : '' ?></td>
                                            <td><?= h($payment->code) ?></td>
                                            <td><?= h($payment->session_id) ?></td>
                                            <td><?= h($payment->paypal_token) ?></td>
                                            <td><?= h($payment->billing_name) ?></td>
                                            <td><?= h($payment->billing_street) ?></td>
                                            <td class="actions">

                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu">
                                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $payment->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $payment->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                        <li class="divider"></li>
                                                        <li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $payment->id], ['escape' => false, 'class' => 'ajaxrowdelete']) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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
