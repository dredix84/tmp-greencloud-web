
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($loyaltyProgram['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in
?>



<div class="loyaltyPrograms form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
                <header class = "panel-heading">
                    <div class = "panel-actions">
                    </div>

                    <h2 class = "panel-title"><?php echo __($emode . ' Loyalty Program'); /* Add */ ?></h2>
                </header>
                <div class = "panel-body">


                    <?= $this->Form->create($loyaltyProgram) ?>
                    <?php
                    echo $this->Form->input('title', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Title'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('description', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Description'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('cost_per_receipt', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Cost Per Receipt'),
                        'templateVars' => ['divClass' => 'col-sm-4 mb-lg']
                    ]);
                    echo $this->Form->input('percentage_per_receipt', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Percentage Per Receipt'),
                        'default' => 0,
                        'templateVars' => ['divClass' => 'col-sm-4 mb-lg']
                    ]);
                    echo $this->Form->input('point_per_receipt', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Point Per Receipt'),
                        'templateVars' => ['divClass' => 'col-sm-4 mb-lg']
                    ]);
                    echo $this->Form->input('points_cost_ratio', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Points Cost Ratio'),
                        'default' => 1,
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('payout_threshold', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Payout Threshold'),
                        'default' => 100,
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('is_active', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Is Active'),
                        'default' => 1,
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('is_default', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Is Default'),
                        'default' => 0,
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