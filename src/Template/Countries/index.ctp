<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
?>
<div class="countries index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?=__('Search'); ?> <?= __('Countries') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create() ?>
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
                    echo $this->Form->end();
                    ?>
                </div>
            </section>


            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Countries') ?></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-md">
                                <?= $this->Html->link(__('New Country <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class'=>'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="_table-responsive">

                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                            <thead>
                                <tr>
                                                                        <th><?= $this->Paginator->sort('id') ?></th>
                                                                        <th><?= $this->Paginator->sort('country_code') ?></th>
                                                                        <th><?= $this->Paginator->sort('title') ?></th>
                                                                        <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($countries as $country): ?>
                                <tr>
                                                                        <td><?= $this->Number->format($country->id) ?></td>
                                                                        <td><?= h($country->country_code) ?></td>
                                                                        <td><?= h($country->title) ?></td>
                                                                        <td class="actions">
                                        
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link(__('View'), ['action' => 'view', $country->id], ['escape'=>false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $country->id], ['escape'=>false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                <li class="divider"></li>
                                                <li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $country->id], ['escape'=>false, 'class'=>'ajaxrowdelete']) ?></li>
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
