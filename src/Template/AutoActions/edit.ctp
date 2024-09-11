
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($autoAction['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="autoActions form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Auto Action'); /* Edit */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($autoAction) ?>
        <?php
            echo $this->Form->input('title', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Title'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('action_type', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Action Type'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('row_count', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Row Count'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('note', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Note'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('data', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Data'),
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