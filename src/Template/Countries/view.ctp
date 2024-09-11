

<div class="countries view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($country->title) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Country Code') ?></th>
            <td><?= h($country->country_code) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($country->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($country->id) ?></td>
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

                    <h2 class="panel-title"><?= __('Related Locations') ?></h2>
                </header>
                <div class="panel-body">
        <?php if (!empty($country->locations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Merchant Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Address Line1') ?></th>
                <th><?= __('Address Line2') ?></th>
                <th><?= __('City') ?></th>
                <th><?= __('Parish State') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Is Active') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Created By') ?></th>
                <th><?= __('Modified By') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($country->locations as $locations): ?>
            <tr>
                <td><?= h($locations->id) ?></td>
                <td><?= h($locations->merchant_id) ?></td>
                <td><?= h($locations->title) ?></td>
                <td><?= h($locations->address_line1) ?></td>
                <td><?= h($locations->address_line2) ?></td>
                <td><?= h($locations->city) ?></td>
                <td><?= h($locations->parish_state) ?></td>
                <td><?= h($locations->country_id) ?></td>
                <td><?= h($locations->is_active) ?></td>
                <td><?= h($locations->created) ?></td>
                <td><?= h($locations->modified) ?></td>
                <td><?= h($locations->created_by) ?></td>
                <td><?= h($locations->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Locations', 'action' => 'view', $locations->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Locations', 'action' => 'edit', $locations->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Locations', 'action' => 'delete', $locations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $locations->id)]) ?>

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
