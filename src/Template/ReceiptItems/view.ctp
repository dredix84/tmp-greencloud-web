

<div class="receiptItems view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($receiptItem->id) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Receipt') ?></th>
            <td><?= $receiptItem->has('receipt') ? $this->Html->link($receiptItem->receipt->id, ['controller' => 'Receipts', 'action' => 'view', $receiptItem->receipt->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Sku') ?></th>
            <td><?= h($receiptItem->sku) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($receiptItem->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($receiptItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($receiptItem->quantity) ?></td>
        </tr>
        <tr>
            <th><?= __('Weight') ?></th>
            <td><?= $this->Number->format($receiptItem->weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Unit Price') ?></th>
            <td><?= $this->Number->format($receiptItem->unit_price) ?></td>
        </tr>
        <tr>
            <th><?= __('Total') ?></th>
            <td><?= $this->Number->format($receiptItem->total) ?></td>
        </tr>

        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($receiptItem->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($receiptItem->modified) ?></td>
        </tr>


    </table>
			
                    </div>
                </section>
            </div>
        </div>                    
                    
                    
                    

</div>
