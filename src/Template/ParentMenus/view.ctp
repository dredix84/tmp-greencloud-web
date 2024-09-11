

<div class="parentMenus view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($parentMenu->title) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($parentMenu->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Before Title') ?></th>
            <td><?= h($parentMenu->before_title) ?></td>
        </tr>
        <tr>
            <th><?= __('After Title') ?></th>
            <td><?= h($parentMenu->after_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Controller') ?></th>
            <td><?= h($parentMenu->controller) ?></td>
        </tr>
        <tr>
            <th><?= __('Action') ?></th>
            <td><?= h($parentMenu->action) ?></td>
        </tr>
        <tr>
            <th><?= __('Permissions') ?></th>
            <td><?= h($parentMenu->permissions) ?></td>
        </tr>
        <tr>
            <th><?= __('Active Link Actions') ?></th>
            <td><?= h($parentMenu->active_link_actions) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($parentMenu->id) ?></td>
        </tr>


        <tr>
            <th><?= __('Is Active') ?></th>
            <td><?= $parentMenu->is_active ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Super Admin Only') ?></th>
            <td><?= $parentMenu->super_admin_only ? __('Yes') : __('No'); ?></td>
         </tr>

        <tr>
        <th><?= __('Url') ?></th>
        <td><?= $this->Text->autoParagraph(h($parentMenu->url)); ?></td>
        </tr>
        <tr>
        <th><?= __('Link Params') ?></th>
        <td><?= $this->Text->autoParagraph(h($parentMenu->link_params)); ?></td>
        </tr>
    </table>
			
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

                    <h2 class="panel-title"><?= __('Related Menus') ?></h2>
                </header>
                <div class="panel-body">
        <?php if (!empty($parentMenu->menus)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Parent Menu Id') ?></th>
                <th><?= __('Before Title') ?></th>
                <th><?= __('After Title') ?></th>
                <th><?= __('Url') ?></th>
                <th><?= __('Controller') ?></th>
                <th><?= __('Action') ?></th>
                <th><?= __('Permissions') ?></th>
                <th><?= __('Link Params') ?></th>
                <th><?= __('Active Link Actions') ?></th>
                <th><?= __('Is Active') ?></th>
                <th><?= __('Super Admin Only') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($parentMenu->menus as $menus): ?>
            <tr>
                <td><?= h($menus->id) ?></td>
                <td><?= h($menus->title) ?></td>
                <td><?= h($menus->parent_menu_id) ?></td>
                <td><?= h($menus->before_title) ?></td>
                <td><?= h($menus->after_title) ?></td>
                <td><?= h($menus->url) ?></td>
                <td><?= h($menus->controller) ?></td>
                <td><?= h($menus->action) ?></td>
                <td><?= h($menus->permissions) ?></td>
                <td><?= h($menus->link_params) ?></td>
                <td><?= h($menus->active_link_actions) ?></td>
                <td><?= h($menus->is_active) ?></td>
                <td><?= h($menus->super_admin_only) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Menus', 'action' => 'view', $menus->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Menus', 'action' => 'edit', $menus->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menus', 'action' => 'delete', $menus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menus->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
                    </div>
                </section>
            </div>
        </div>                    
                  

    <?php endif; ?>
    </div>
</div>
