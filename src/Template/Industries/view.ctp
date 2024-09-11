

<div class="industries view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($industry->title) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($industry->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($industry->id) ?></td>
        </tr>

        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($industry->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($industry->modified) ?></td>
        </tr>


        <tr>
        <th><?= __('Description') ?></th>
        <td><?= $this->Text->autoParagraph(h($industry->description)); ?></td>
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

                    <h2 class="panel-title"><?= __('Related Merchants') ?></h2>
                </header>
                <div class="panel-body">
        <?php if (!empty($industry->merchants)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Industry Id') ?></th>
                <th><?= __('About') ?></th>
                <th><?= __('Logo') ?></th>
                <th><?= __('Contact Name') ?></th>
                <th><?= __('Contact Phone') ?></th>
                <th><?= __('Contact Position') ?></th>
                <th><?= __('Contact Email') ?></th>
                <th><?= __('Website') ?></th>
                <th><?= __('Print Cost') ?></th>
                <th><?= __('Username') ?></th>
                <th><?= __('Password') ?></th>
                <th><?= __('Is Active') ?></th>
                <th><?= __('Is Locked') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($industry->merchants as $merchants): ?>
            <tr>
                <td><?= h($merchants->id) ?></td>
                <td><?= h($merchants->name) ?></td>
                <td><?= h($merchants->industry_id) ?></td>
                <td><?= h($merchants->about) ?></td>
                <td><?= h($merchants->logo) ?></td>
                <td><?= h($merchants->contact_name) ?></td>
                <td><?= h($merchants->contact_phone) ?></td>
                <td><?= h($merchants->contact_position) ?></td>
                <td><?= h($merchants->contact_email) ?></td>
                <td><?= h($merchants->website) ?></td>
                <td><?= h($merchants->print_cost) ?></td>
                <td><?= h($merchants->username) ?></td>
                <td><?= h($merchants->password) ?></td>
                <td><?= h($merchants->is_active) ?></td>
                <td><?= h($merchants->is_locked) ?></td>
                <td><?= h($merchants->created) ?></td>
                <td><?= h($merchants->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Merchants', 'action' => 'view', $merchants->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Merchants', 'action' => 'edit', $merchants->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Merchants', 'action' => 'delete', $merchants->id], ['confirm' => __('Are you sure you want to delete # {0}?', $merchants->id)]) ?>

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
