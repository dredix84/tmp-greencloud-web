
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($payment['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="payments form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Payment'); /* Edit */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($payment) ?>
        <?php
            echo $this->Form->input('merchant_id', [
                'options' => $merchants,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('code', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Code'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('session_id', [
                    'class' => 'form-control input-md',
                    'empty' => __('Select Session ...'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('paypal_token', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Paypal Token'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('billing_name', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Billing Name'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('billing_street', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Billing Street'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('billing_city', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Billing City'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('billing_state', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Billing State'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('billing_zip', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Billing Zip'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('billing_country', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Billing Country'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('billing_phone', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Billing Phone'),
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
            echo $this->Form->input('couponamount', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Couponamount'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('certificate_id', [
                    'class' => 'form-control input-md',
                    'empty' => __('Select Certificate ...'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('certificateamount', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Certificateamount'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('total', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Total'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('payment_type', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Payment Type'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('cardtype', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Cardtype'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('accountnumber', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Accountnumber'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('expirationmonth', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Expirationmonth'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('expirationyear', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Expirationyear'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('status', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Status'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('gateway', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Gateway'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('gateway_environment', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Gateway Environment'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('payment_transaction_id', [
                    'class' => 'form-control input-md',
                    'empty' => __('Select Payment Transaction ...'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('subscription_transaction_id', [
                    'class' => 'form-control input-md',
                    'empty' => __('Select Subscription Transaction ...'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('note', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Note'),
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