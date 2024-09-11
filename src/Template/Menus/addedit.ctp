
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($menu['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in
?>



<div class="menus form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
                <header class = "panel-heading">
                    <div class = "panel-actions">
                    </div>

                    <h2 class = "panel-title"><?php echo __($emode . ' Menu'); /* Add */ ?></h2>
                </header>
                <div class = "panel-body">


                    <?= $this->Form->create($menu) ?>
                    <?php
                    echo $this->Form->input('title', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Title'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('parent_menu_id', [
                        'class' => 'form-control input-md',
                        'empty' => __('Select Parent Menu ...'),
                        'templateVars' => ['divClass' => 'col-sm-3 mb-lg']
                    ]);
                    echo $this->Form->input('sort_order', [
                        'class' => 'form-control input-md',
                        'label' => __('Sort'),
                        'default' => 1,
                        'templateVars' => ['divClass' => 'col-sm-3 mb-lg']
                    ]);
                    echo $this->Form->input('before_title', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Before Title'),
                        'default' => '<i class="fa fa-star" aria-hidden="true"></i><span>',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('after_title', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('After Title'),
                        'default' => '</span>',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('url', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Url'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('controller', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Controller'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('action', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Action'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('permissions', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Permissions'),
                        'default' => '*',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('role_id', [
                        'empty' => 'Any role',
                        'class' => 'form-control input-md',
                        'placeholder' => __('Permissions'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('link_params', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Link Params'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('active_link_actions', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Active Link Actions'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    
                    echo $this->Form->input('is_active', [
                        'class' => '',
                        'default' => 1,
                        'options' => ['No', 'Yes'],
                        'placeholder' => __('Is Active'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('super_admin_only', [
                        'class' => '',
                        'options' => ['No', 'Yes'],
                        'placeholder' => __('Super Admin Only'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
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