
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($credit['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in
?>



<div class="credits form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
                <header class = "panel-heading">
                    <div class = "panel-actions">
                    </div>

                    <h2 class = "panel-title"><?php echo __($emode . ' Credit'); /* Add */ ?></h2>
                </header>
                <div class = "panel-body">


                    <?= $this->Form->create($credit) ?>
                    <?php
                    echo $this->Form->input('merchant_id', [
                        'options' => $merchants,
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('credit_amount', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Credit Amount'),
                        'default' => 1,
                        'min' => 1,
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    /*echo $this->Form->input('payment_id', [
                        'options' => $payments,
                        'empty' => 'No payment attached',
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);*/
                    echo $this->Form->input('note', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Note'),
                        'placeholder' => __('Note about these credits being added'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('added_by', [
                        'type' => 'hidden',
                        'default' => $userinfo['id']
                    ]);
                    ?>

                    <hr class="dotted" />
                    <h4>Payment Details Below</h4>

                    <?php
                    echo $this->Form->input('payment.payment_type', [
                        'options' => Cake\Core\Configure::read('payment_types'),
                        'empty' => 'No payment type',
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('payment.total', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Amount Paid'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    
                    echo $this->Form->input('payment.payment_transaction_id', [
                        'label' => __('Transaction ID'),
                        'type' => 'text',
                        'placeholder' => __('Transaction ID or check number'),
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('payment.status', [
                        'options' => Cake\Core\Configure::read('payment_statuses'),
                        'empty' => 'No payment status',
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('payment.note', [
                        'class' => 'form-control input-md',
                        //'type' => 'textarea',
                        'placeholder' => __('Notes about the payment'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);


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