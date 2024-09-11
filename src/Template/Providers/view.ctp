

<div class="providers view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($provider->name) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($provider->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Name') ?></th>
            <td><?= h($provider->contact_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Phone') ?></th>
            <td><?= h($provider->contact_phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Position') ?></th>
            <td><?= h($provider->contact_position) ?></td>
        </tr>
        <tr>
            <th><?= __('Contact Email') ?></th>
            <td><?= h($provider->contact_email) ?></td>
        </tr>
        <tr>
            <th><?= __('Website') ?></th>
            <td><?= h($provider->website) ?></td>
        </tr>
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($provider->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($provider->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Finder Words') ?></th>
            <td><?= h($provider->finder_words) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($provider->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Print Cost') ?></th>
            <td><?= $this->Number->format($provider->print_cost) ?></td>
        </tr>

        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($provider->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($provider->modified) ?></td>
        </tr>

        <tr>
            <th><?= __('Is Active') ?></th>
            <td><?= $provider->is_active ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Is Locked') ?></th>
            <td><?= $provider->is_locked ? __('Yes') : __('No'); ?></td>
         </tr>

        <tr>
        <th><?= __('Description') ?></th>
        <td><?= $this->Text->autoParagraph(h($provider->description)); ?></td>
        </tr>
        <tr>
        <th><?= __('Logo') ?></th>
        <td><?= $this->Text->autoParagraph(h($provider->logo)); ?></td>
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

                    <h2 class="panel-title"><?= __('Related Users') ?></h2>
                </header>
                <div class="panel-body">
        <?php if (!empty($provider->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Username') ?></th>
                <th><?= __('Password') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Phone') ?></th>
                <th><?= __('Last Login') ?></th>
                <th><?= __('Role Id') ?></th>
                <th><?= __('Merchant Id') ?></th>
                <th><?= __('Provider Id') ?></th>
                <th><?= __('Is Active') ?></th>
                <th><?= __('Is Locked') ?></th>
                <th><?= __('Activated') ?></th>
                <th><?= __('Activation Code') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('User Registered') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($provider->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->phone) ?></td>
                <td><?= h($users->last_login) ?></td>
                <td><?= h($users->role_id) ?></td>
                <td><?= h($users->merchant_id) ?></td>
                <td><?= h($users->provider_id) ?></td>
                <td><?= h($users->is_active) ?></td>
                <td><?= h($users->is_locked) ?></td>
                <td><?= h($users->activated) ?></td>
                <td><?= h($users->activation_code) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td><?= h($users->user_registered) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>                    
                  

    
    </div>
</div>
