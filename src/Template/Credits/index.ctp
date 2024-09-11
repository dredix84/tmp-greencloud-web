<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];
?>
<div class="credits index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Credits') ?></h2>
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

                    <h2 class="panel-title"><?= __('Credits') ?> <small>(<?= $count ?> <?= $count == 1 ? __('Record found') : __('Records found') ?> )</small></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-md">
                                <?= $this->Html->link(__('New Credit <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="_table-responsive">

                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover table-no-more mb-none">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('id') ?></th>
                                    <th><?= $this->Paginator->sort('merchant_id') ?></th>
                                    <th><?= $this->Paginator->sort('payment_id') ?></th>
                                    <th><?= $this->Paginator->sort('credit_amount') ?></th>
                                    <th><?= $this->Paginator->sort('added_by') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th><?= $this->Paginator->sort('modified') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($credits as $credit): ?>
                                    <tr>
                                        <td data-title="<?= __('Credit ID') ?>"><?= $this->Number->format($credit->id) ?></td>
                                        <td data-title="<?= __('Merchant') ?>"><?= $credit->has('merchant') ? $this->Html->link($credit->merchant->name, ['controller' => 'Merchants', 'action' => 'view', $credit->merchant->id]) : '' ?></td>
                                        <td data-title="<?= __('Payment Info') ?>"><?= $credit->has('payment') ? $this->Html->link($credit->payment->id . ' - ' . $credit->payment->payment_transaction_id, ['controller' => 'Payments', 'action' => 'view', $credit->payment->id]) : '' ?></td>
                                        <td data-title="<?= __('Credit Amount') ?>"><?= $this->Number->format($credit->credit_amount) ?></td>
                                        <td data-title="<?= __('Added By') ?>"><?= $this->Number->format($credit->added_by) ?></td>
                                        <td data-title="<?= __('Created') ?>"><?= h($credit->created) ?></td>
                                        <td data-title="<?= __('Modified') ?>"><?= h($credit->modified) ?></td>
                                        <td data-title="<?= __('Actions') ?>" class="actions">
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                                <ul class="dropdown-menu">
                                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $credit->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $credit->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                    <li class="divider"></li>
                                                    <li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $credit->id], ['escape' => false, 'class' => 'ajaxrowdelete']) ?></li>
                                                </ul>
                                            </div>
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
