
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($merchant['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="merchants form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Merchant'); /* Add */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($merchant) ?>
        <?php
            echo $this->Form->input('code', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Code'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('name', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Name'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('industry_id', [
                'options' => $industries, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('payment_structure_id', [
                'options' => $paymentStructures, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                ]);
            echo $this->Form->input('loyalty_program_id', [
                'options' => $loyaltyPrograms, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                ]);
            echo $this->Form->input('about', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('About'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            /*echo $this->Form->input('logo', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Logo'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);*/
            echo $this->Form->input('contact_name', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Name'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('contact_position', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Position'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('contact_phone', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Phone'),
                    'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                ]);
            echo $this->Form->input('contact_email', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Email'),
                    'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                ]);
            echo $this->Form->input('website', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Website'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            /*echo $this->Form->input('print_cost', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Print Cost'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('username', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Username'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('password', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Password'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);*/
            echo $this->Form->input('is_active', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Is Active'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('is_locked', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Is Locked'),
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