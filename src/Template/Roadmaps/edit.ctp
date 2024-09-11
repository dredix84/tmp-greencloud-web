
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($roadmap['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="roadmaps form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Roadmap'); /* Edit */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($roadmap) ?>
        <?php
            echo $this->Form->input('title', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Title'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('category', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Category'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('status', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Status'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('description', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Description'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('delivery_date', ['empty' => true]);
            echo $this->Form->input('user_id', [
                'options' => $users, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('priority', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Priority'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('tags', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Tags'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('comments', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Comments'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('icon', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Icon'),
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