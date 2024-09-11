
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($provider['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="providers form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Provider'); /* Add */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($provider) ?>
        <?php
            echo $this->Form->input('name', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Name'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('description', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Description'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('logo', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Logo'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('contact_name', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Name'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('contact_phone', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Phone'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('contact_position', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Position'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('contact_email', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Contact Email'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('website', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Website'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('print_cost', [
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
                ]);
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
            echo $this->Form->input('finder_words', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Finder Words'),
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