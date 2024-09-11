<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
?>


<div class="roles form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
                <header class = "panel-heading">
                    <div class = "panel-actions">
                    </div>

                    <h2 class = "panel-title"><?php echo __('Edit Permissions for ') . $role->title; ?></h2>
                </header>
                <div class = "panel-body">

                    <?= $this->Form->create($role) ?>
                    <?php
                    $currentPerms = (!empty($role['permissions']) ? json_decode($role['permissions']) : []);
                    ?>

                    <input type="hidden" name="permissions" value="">
                    <?php
                    $permissions_list = \Cake\Core\Configure::read('permissions');
                    //echo pr($permissions_list);

                    foreach ($permissions_list as $perHead => $perDetail) {
                        ?>

                        <div class="input select  col-sm-4 mb-lg">
                            <h2><?= __($perHead) ?></h2>
                            <?php foreach ($perDetail as $pval => $pkey) { ?>
                                <div class="checkbox">
                                    <label for="<?= $pval ?>" title="Permission: <?= $pkey ?> (<?= $pval ?>)">
                                        <input type="checkbox" id="<?= $pval ?>" value="<?= $pval ?>" name="permissions[]" <?= (in_array($pval, $currentPerms) ? 'checked' : '') ?>><?= $pkey ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                    }

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

<link rel="stylesheet" href="<?= WEBROOT ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
<script src="<?= WEBROOT ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>


<script>
    /*$(function() {
     
     });*/
</script>