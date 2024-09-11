<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
?>
<div class="row">
    <div class="col-md-12">
        <section class="panel panel-info">
            <header class="panel-heading">
                <h2 class="panel-title"><?= ('Change My Password') ?></h2>
            </header>
            <div class="panel-body">

                <?= $this->Form->create($user) ?>
                <?php
                echo $this->Form->input('current_password', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Your current password'),
                    'type' => 'password',
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
                echo $this->Form->input('new_password', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('New Password'),
                    'type' => 'password',
                    'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                ]);
                echo $this->Form->input('confirm_new_password', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Confirm New Password'),
                    'type' => 'password',
                    'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                ]);
                ?>
                <?php
                echo $this->Form->button(__('Change Password'), [
                    'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                    'templateVars' => ['divClass' => 'col-sm-12']
                ]);
                echo $this->Form->end();
                ?>
            </div>
        </section>
    </div>
</div>

