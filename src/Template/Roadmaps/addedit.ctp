
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($roadmap['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in
$webroot = $this->Url->build('/', true);
?>



<div class="roadmaps form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
                <header class = "panel-heading">
                    <div class = "panel-actions">
                    </div>

                    <h2 class = "panel-title"><?php echo __($emode . ' Roadmap'); /* Add */ ?></h2>
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
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('icon', [
                        'class' => 'form-control input-md',
                        'options' => $icons,
                        'placeholder' => __('Icon'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('delivery_date', [
                        'type' => 'text',
                        'data-plugin-datepicker',
                        'data-plugin-options' => '{ "format": "yyyy-mm-dd" }',
                        'readonly',
                        'value' => (isset($roadmap['delivery_date'])?  $roadmap['delivery_date']->setToStringFormat('yyyy-MM-dd'):''),
                        'empty' => true,
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('status', [
                        'class' => 'form-control input-md',
                        'options' => $statuses,
                        'placeholder' => __('Status'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('priority', [
                        'class' => 'form-control input-md',
                        'options' => $priorities,
                        'placeholder' => __('Priority'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('user_id', [
                        'options' => $users,
                        'empty' => true,
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('description', [
                        'class' => 'form-control input-md',
                        'data-plugin-summernote',
                        'data-plugin-options' => '{ "height": 180, "codemirror": { "theme": "ambiance" } }',
                        'placeholder' => __('Description'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);


                    echo $this->Form->input('tags', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Tags'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    /*echo $this->Form->input('comments', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Comments'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);*/
                    
                    
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

<link rel="stylesheet" href="<?= $webroot ?>assets/vendor/summernote/summernote.css" />
<link rel="stylesheet" href="<?= $webroot ?>assets/vendor/summernote/summernote-bs3.css" />
<script src="<?= $webroot ?>assets/vendor/summernote/summernote.js"></script>
<script src="<?= $webroot ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        setDatePicker('#delivery-date');
        niceEditor('#description');
    });
</script>