

<div class="menus view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($menu->title) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
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
            <th><?= __('Parent Menu Id') ?></th>
            <td><?= $this->Number->format($menu->parent_menu_id) ?></td>
        </tr>


        <tr>
            <th><?= __('Is Active') ?></th>
            <td><?= $menu->is_active ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Super Admin Only') ?></th>
            <td><?= $menu->super_admin_only ? __('Yes') : __('No'); ?></td>
         </tr>

        <tr>
        <th><?= __('Url') ?></th>
        <td><?= $this->Text->autoParagraph(h($menu->url)); ?></td>
        </tr>
        <tr>
        <th><?= __('Link Params') ?></th>
        <td><?= $this->Text->autoParagraph(h($menu->link_params)); ?></td>
        </tr>
    </table>
			
                    </div>
                </section>
            </div>
        </div>                    
                    
                    
                    

</div>
