
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($receipt['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="receipts form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Receipt'); /* Add */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($receipt) ?>
        <?php
            echo $this->Form->input('merchant_id', [
                'options' => $merchants,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('provider_id', [
                'options' => $providers, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('terminal', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Terminal'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('user_id', [
                'options' => $users, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('receipt_number', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Receipt Number'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('receipt_date', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Receipt Date'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('claim_number', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Claim Number'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('discount_type', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Discount Type'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('discount', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Discount'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('subtotal', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Subtotal'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('tax', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Tax'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('total', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Total'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('payment_type_id', [
                'options' => $paymentTypes, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('user_note', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('User Note'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('note', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Note'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('receipt_text_data', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Receipt Text Data'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('receipt_file', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Receipt File'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('should_email', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Should Email'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('emailed', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Emailed'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('date_emailed', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Date Emailed'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('email_cost', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Email Cost'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('systen_note', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Systen Note'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('seen', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Seen'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
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