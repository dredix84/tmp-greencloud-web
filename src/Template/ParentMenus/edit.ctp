
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($parentMenu['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="parentMenus form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Parent Menu'); /* Edit */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($parentMenu) ?>
        <?php
            echo $this->Form->input('title', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Title'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('before_title', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Before Title'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('after_title', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('After Title'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('url', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Url'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('controller', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Controller'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('action', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Action'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('permissions', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Permissions'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('link_params', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Link Params'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('active_link_actions', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Active Link Actions'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('is_active', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Is Active'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('super_admin_only', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Super Admin Only'),
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