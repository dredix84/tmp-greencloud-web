

<div class="invoices view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($invoice->id) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Invoice Number') ?></th>
            <td><?= h($invoice->invoice_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Invoice Status') ?></th>
            <td><?= $invoice->has('invoice_status') ? $this->Html->link($invoice->invoice_status->title, ['controller' => 'InvoiceStatuses', 'action' => 'view', $invoice->invoice_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Merchant') ?></th>
            <td><?= $invoice->has('merchant') ? $this->Html->link($invoice->merchant->name, ['controller' => 'Merchants', 'action' => 'view', $invoice->merchant->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('From Address') ?></th>
            <td><?= h($invoice->from_address) ?></td>
        </tr>
        <tr>
            <th><?= __('To Address') ?></th>
            <td><?= h($invoice->to_address) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th><?= __('To Merchant Id') ?></th>
            <td><?= $this->Number->format($invoice->to_merchant_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Shipping') ?></th>
            <td><?= $this->Number->format($invoice->shipping) ?></td>
        </tr>
        <tr>
            <th><?= __('Discount Type') ?></th>
            <td><?= $this->Number->format($invoice->discount_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Discount') ?></th>
            <td><?= $this->Number->format($invoice->discount) ?></td>
        </tr>
        <tr>
            <th><?= __('Sub Total') ?></th>
            <td><?= $this->Number->format($invoice->sub_total) ?></td>
        </tr>
        <tr>
            <th><?= __('Grand Total') ?></th>
            <td><?= $this->Number->format($invoice->grand_total) ?></td>
        </tr>
        <tr>
            <th><?= __('Created By') ?></th>
            <td><?= $this->Number->format($invoice->created_by) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($invoice->modified_by) ?></td>
        </tr>

        <tr>
            <th><?= __('Invoice Date') ?></th>
            <td><?= h($invoice->invoice_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Due Date') ?></th>
            <td><?= h($invoice->due_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($invoice->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($invoice->modified) ?></td>
        </tr>

        <tr>
            <th><?= __('Paid') ?></th>
            <td><?= $invoice->paid ? __('Yes') : __('No'); ?></td>
         </tr>

        <tr>
        <th><?= __('Note') ?></th>
        <td><?= $this->Text->autoParagraph(h($invoice->note)); ?></td>
        </tr>
        <tr>
        <th><?= __('Private Note') ?></th>
        <td><?= $this->Text->autoParagraph(h($invoice->private_note)); ?></td>
        </tr>
    </table>
			
                    </div>
                </section>
            </div>
        </div>                    
                    
                    
                    

</div>
