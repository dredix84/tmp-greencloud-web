<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
?>
<div class="menus index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Menus') ?></h2>
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

                    <h2 class="panel-title"><?= __('Menus') ?></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-md">
                                <?= $this->Html->link(__('New Menu <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="_table-responsive">

                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('parent_menu_id') ?></th>
                                    <th><?= $this->Paginator->sort('before_title') ?></th>
                                    <th><?= $this->Paginator->sort('after_title') ?></th>
                                    <th><?= $this->Paginator->sort('controller') ?></th>
                                    <th><?= $this->Paginator->sort('action') ?></th>
                                    <th><?= $this->Paginator->sort('sort_order', 'Sorting') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($menus as $menu): ?>
                                    <tr class="<?= (!$menu->is_active ? 'danger' : '') ?>">
                                        <td></td>
                                        <td data-title='title' ><?= $menu->before_title . ' ' . h($menu->title) . $menu->after_title ?></td>
                                        <td></td>
                                        <td><?= h($menu->before_title) ?></td>
                                        <td><?= h($menu->after_title) ?></td>
                                        <td><?= h($menu->controller) ?></td>
                                        <td><?= h($menu->action) ?></td>
                                        <td><?= h($menu->sort_order) ?></td>
                                        <td class="actions">

                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                                <ul class="dropdown-menu">
                                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $menu->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                    <li class="divider"></li>
                                                    <li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $menu->id], ['escape' => false, 'class' => 'ajaxrowdelete']) ?></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php foreach ($menu->menus as $cmenu): ?>
                                        <tr class="<?= (!$cmenu->is_active ? 'danger' : '') ?>">
                                            <td>|__</td>
                                            <td data-title='title' ><?= h($cmenu->title) ?></td>
                                            <td><?= h($menu->title) ?></td>
                                            <td><?= h($cmenu->before_title) ?></td>
                                            <td><?= h($cmenu->after_title) ?></td>
                                            <td><?= h($cmenu->controller) ?></td>
                                            <td><?= h($cmenu->action) ?></td>
                                            <td><?= $cmenu->sort_order ?></td>
                                            <td class="actions">

                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu">
                                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $cmenu->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $cmenu->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                        <li class="divider"></li>
                                                        <li><?= $this->Html->link(__('Delete'), ['action' => 'delete', $cmenu->id], ['escape' => false, 'class' => 'ajaxrowdelete']) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
