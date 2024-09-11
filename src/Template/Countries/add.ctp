
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
?>
    
        

        
<div class="countries form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?= __('Add Country') ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($country) ?>
        <?php
            echo $this->Form->input('country_code', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Country Code'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('title', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Title'),
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
