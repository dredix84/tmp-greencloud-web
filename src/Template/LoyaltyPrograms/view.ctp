

<div class="loyaltyPrograms view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($loyaltyProgram->title) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($loyaltyProgram->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Cost Per Receipt') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->cost_per_receipt) ?></td>
        </tr>
        <tr>
            <th><?= __('Percentage Per Receipt') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->percentage_per_receipt) ?></td>
        </tr>
        <tr>
            <th><?= __('Point Per Receipt') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->point_per_receipt) ?></td>
        </tr>
        <tr>
            <th><?= __('Points Cost Ratio') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->points_cost_ratio) ?></td>
        </tr>
        <tr>
            <th><?= __('Payout Threshold') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->payout_threshold) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($loyaltyProgram->modified_by) ?></td>
        </tr>

        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($loyaltyProgram->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($loyaltyProgram->modified) ?></td>
        </tr>

        <tr>
            <th><?= __('Is Active') ?></th>
            <td><?= $loyaltyProgram->is_active ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('Is Default') ?></th>
            <td><?= $loyaltyProgram->is_default ? __('Yes') : __('No'); ?></td>
         </tr>

        <tr>
        <th><?= __('Description') ?></th>
        <td><?= $this->Text->autoParagraph(h($loyaltyProgram->description)); ?></td>
        </tr>
    </table>
			
                    </div>
                </section>
            </div>
        </div>                    
                    
                    
                    

</div>
