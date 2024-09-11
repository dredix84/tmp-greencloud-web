<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];
?>
<div class="loyaltyPrograms index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?=__('Search'); ?> <?= __('Loyalty Programs') ?></h2>
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
                    echo $this->Form->input('a', ['type' => 'hidden', 'value'=>'search']);
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

                    <h2 class="panel-title"><?= __('Loyalty Programs') ?> <small>(<?=$count?> <?= $count==1?__('Record found'):__('Records found')?> )</small></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-md">
                                <?= $this->Html->link(__('New Loyalty Program <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class'=>'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="_table-responsive">

                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                            <thead>
                                <tr>
                                                                        <th><?= $this->Paginator->sort('id') ?></th>
                                                                        <th><?= $this->Paginator->sort('title') ?></th>
                                                                        <th><?= $this->Paginator->sort('cost_per_receipt') ?></th>
                                                                        <th><?= $this->Paginator->sort('percentage_per_receipt') ?></th>
                                                                        <th><?= $this->Paginator->sort('point_per_receipt') ?></th>
                                                                        <th><?= $this->Paginator->sort('points_cost_ratio') ?></th>
                                                                        <th><?= $this->Paginator->sort('payout_threshold') ?></th>
                                                                        <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($loyaltyPrograms as $loyaltyProgram): ?>
                                <tr>
                                                                        <td><?= $this->Number->format($loyaltyProgram->id) ?></td>
                                                                        <td data-title='title' ><?= h($loyaltyProgram->title) ?></td>
                                                                        <td><?= $this->Number->format($loyaltyProgram->cost_per_receipt) ?></td>
                                                                        <td><?= $this->Number->format($loyaltyProgram->percentage_per_receipt) ?></td>
                                                                        <td><?= $this->Number->format($loyaltyProgram->point_per_receipt) ?></td>
                                                                        <td><?= $this->Number->format($loyaltyProgram->points_cost_ratio) ?></td>
                                                                        <td><?= $this->Number->format($loyaltyProgram->payout_threshold) ?></td>
                                                                        <td class="actions">
                                        
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link(__('View'), ['action' => 'view', $loyaltyProgram->id], ['escape'=>false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $loyaltyProgram->id], ['escape'=>false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                <li class="divider"></li>
                                                <li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $loyaltyProgram->id], ['escape'=>false, 'class'=>'ajaxrowdelete']) ?></li>
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
            <?= $this->Paginator->prev(__('previous'), ['escape'=>false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next'), ['escape'=>false]) ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
