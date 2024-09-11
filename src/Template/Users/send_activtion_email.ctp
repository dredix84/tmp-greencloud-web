<?php
$this->layout = 'login_signup';
$this->loadHelper('Form', [
    'templates' => 'login_form',
]);
?>
<div class="panel panel-sign">
    <div class="panel-title-sign mt-xl text-right">
        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> <?=__('Send Activation Email')?></h2>
    </div>
    <div class="panel-body">
        <div class="alert alert-info">
            <p class="m-none text-weight-semibold h6"><?= __('Enter your e-mail below and we will send you the activation email!') ?></p>
        </div>

        <?= $this->Form->create() ?>
   
        <?php
        echo $this->Form->input('email', [
            'class' => 'form-control input-lg',
            'label' => false,
            'required',
            'placeholder' => __('Your e-mail'),
            'templateVars' => [
                'divClass' => 'form-group mb-none',
                'beforeInput' => '<div class="input-group">',
                'afterInput' => '<span class="input-group-btn"><button type="submit" class="btn btn-primary btn-lg">'.__('Send!').'</button></span></div>'
            ]
        ]);
        ?>

        <p class="text-center mt-lg"><?= __('Remembered?') ?> <?= $this->Html->link(__('Sign In!'), ['controller' => 'Users', 'action' => 'login']); ?></p>
        <?= $this->Form->end() ?>
    </div>
</div>

