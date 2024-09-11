<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];
?>
<div class="merchants index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Merchants') ?></h2>
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

                    <h2 class="panel-title"><?= __('Merchants') ?> <small>(<?= $count ?> <?= $count == 1 ? __('Record found') : __('Records found') ?> )</small></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-md">
                                <?= $this->Html->link(__('New Merchant <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="_table-responsive">
                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                                <thead>
                                    <tr>
                                        <th><?= $this->Paginator->sort('id') ?></th>
                                        <th><?= $this->Paginator->sort('code') ?></th>
                                        <th><?= $this->Paginator->sort('name') ?></th>
                                        <th><?= $this->Paginator->sort('industry_id') ?></th>
                                        <th><?= $this->Paginator->sort('payment_structure_id') ?></th>
                                        <th><?= $this->Paginator->sort('loyalty_program_id') ?></th>
                                        <th><?= $this->Paginator->sort('contact_name') ?></th>
                                        <th><?= $this->Paginator->sort('currency') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($merchants as $merchant): ?>
                                        <?php
                                        $trClass = ($this->Permission->isAdmin() && $merchant->active_status == false) ? 'danger' : '';
                                        ?>
                                        <tr class="<?= $trClass ?>">
                                            <td><?= $this->Number->format($merchant->id) ?></td>
                                            <td><?= h($merchant->code) ?></td>
                                            <td>
                                                <?= $this->Html->link(h($merchant->business_title), ['action' => 'view', $merchant->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                                            </td>
                                            <td><?= $merchant->has('industry') ? $this->Html->link($merchant->industry->title, ['controller' => 'Industries', 'action' => 'view', $merchant->industry->id]) : '' ?></td>
                                            <td><?= $merchant->has('payment_structure') ? $this->Html->link($merchant->payment_structure->title, ['controller' => 'PaymentStructures', 'action' => 'view', $merchant->payment_structure->id]) : '' ?></td>
                                            <td><?= $merchant->has('loyalty_program') ? $this->Html->link($merchant->loyalty_program->title, ['controller' => 'LoyaltyPrograms', 'action' => 'view', $merchant->loyalty_program->id]) : '' ?></td>
                                            <td><?= h($merchant->contact_name) ?></td>
                                            <td><?= h($merchant->currency) ?></td>
                                            <td class="actions">

                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu">
                                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $merchant->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $merchant->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                        <li class="divider"></li>
                                                        <li><?= $this->Html->link(__('Deactive Account'), ['action' => 'deactivate', $merchant->id], ['escape' => false, 'class' => '']) ?></li>
                                                        <?php if ($this->Permission->isAdmin()) { ?>
                                                            <li class="divider"></li>
                                                            <li><?= $this->Html->link(__('Change Activation'), ['action' => 'changeActivationStatus', $merchant->id], ['escape' => false]) ?></li>
                                                        <?php } ?>
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
