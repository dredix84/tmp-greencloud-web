<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($menu->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Before Title') ?></th>
            <td><?= h($menu->before_title) ?></td>
        </tr>
        <tr>
            <th><?= __('After Title') ?></th>
            <td><?= h($menu->after_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Controller') ?></th>
            <td><?= h($menu->controller) ?></td>
        </tr>
        <tr>
            <th><?= __('Action') ?></th>
            <td><?= h($menu->action) ?></td>
        </tr>
        <tr>
            <th><?= __('Permissions') ?></th>
            <td><?= h($menu->permissions) ?></td>
        </tr>
        <tr>
            <th><?= __('Active Link Actions') ?></th>
            <td><?= h($menu->active_link_actions) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Menu Id') ?></th>
            <td><?= $this->Number->format($menu->menu_id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Url') ?></h4>
        <?= $this->Text->autoParagraph(h($menu->url)); ?>
    </div>
    <div class="row">
        <h4><?= __('Link Params') ?></h4>
        <?= $this->Text->autoParagraph(h($menu->link_params)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Menus') ?></h4>
        <?php if (!empty($menu->menus)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Menu Id') ?></th>
                <th><?= __('Before Title') ?></th>
                <th><?= __('After Title') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Controller') ?></th>
                <th><?= __('Action') ?></th>
                <th><?= __('Permissions') ?></th>
                <th><?= __('Link Params') ?></th>
                <th><?= __('Active Link Actions') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menu->menus as $menus): ?>
            <tr>
                <td><?= h($menus->id) ?></td>
                <td><?= h($menus->title) ?></td>
                <td><?= h($menus->menu_id) ?></td>
                <td><?= h($menus->before_title) ?></td>
                <td><?= h($menus->after_title) ?></td>
                <td><?= h($menus->url) ?></td>
                <td><?= h($menus->controller) ?></td>
                <td><?= h($menus->action) ?></td>
                <td><?= h($menus->permissions) ?></td>
                <td><?= h($menus->link_params) ?></td>
                <td><?= h($menus->active_link_actions) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Menus', 'action' => 'view', $menus->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Menus', 'action' => 'edit', $menus->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menus', 'action' => 'delete', $menus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menus->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
