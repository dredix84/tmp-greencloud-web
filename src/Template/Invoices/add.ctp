
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($invoice['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in
?>



<div class="invoices form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
                <header class = "panel-heading">
                    <div class = "panel-actions">
                    </div>

                    <h2 class = "panel-title"><?php echo __($emode . ' Invoice'); /* Add */ ?></h2>
                </header>
                <div class = "panel-body">


                    <?= $this->Form->create($invoice) ?>
                    <?php
                    echo $this->Form->input('invoice_number', [
                        'class' => 'form-control input-md',
                        'default' => date('YmdHis'),
                        'placeholder' => __('Invoice Number'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('invoice_date', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Invoice Date'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    
                    echo $this->Form->input('due_date', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Due Date'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    
                    /*echo $this->Form->input('invoice_status_id', [
                        'options' => $invoiceStatuses,
                        'empty' => true,
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);*/
                    
                    echo $this->Form->input('merchant_id', [
                        'options' => $merchants,
                        'empty' => true,
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('to_merchant_id', [
                        'class' => 'form-control input-md',
                        'empty' => __('Select To Merchant ...'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('from_address', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('From Address'),
                        'type' => 'textarea',
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('to_address', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('To Address'),
                        'type' => 'textarea',
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    /*echo $this->Form->input('shipping', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Shipping'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('discount_type', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Discount Type'),
                        'options' => \Cake\Core\Configure::read('discount_types'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('discount', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Discount'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('sub_total', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Sub Total'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('grand_total', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Grand Total'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('paid', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Paid'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('note', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Note'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('private_note', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Private Note'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);*/
                    ?>
                    <?php
                    echo $this->Form->button(__('Submit'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-12']
                    ]);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>
        </div>    
    </div>
</div>

<script>
    /*$(function() {
     
     });*/
</script>