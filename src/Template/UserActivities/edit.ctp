
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($userActivity['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="userActivities form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' User Activity'); /* Edit */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($userActivity) ?>
        <?php
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
            echo $this->Form->input('after_action', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('After Action'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('ip_address', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Ip Address'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('title', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Title'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('note', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Note'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('risk', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Risk'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('other_data', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Other Data'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('flag', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Flag'),
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