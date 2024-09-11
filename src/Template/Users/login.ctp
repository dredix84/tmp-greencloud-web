<?php
$this->layout = 'login_signup';
$this->loadHelper('Form', [
    'templates' => 'login_form',
]);
?>




<div class="panel panel-sign">
    <div class="panel-title-sign mt-xl text-right">
        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> <?=__('Sign In')?></h2>
    </div>
    <div class="panel-body">
        <?= $this->Form->create() ?>

        <?php
        echo $this->Form->input('username', [
            'class' => 'form-control input-lg',
            'placeholder' => __('Username'),
            'templateVars' => [
                'divClass' => 'form-group mb-lg',
                'beforeInput' => '<div class="input-group input-group-icon">',
                'afterInput' => '<span class="input-group-addon"><span class="icon icon-lg"><i class="fa fa-user"></i></span></span></div>'
            ]
        ]);
        echo $this->Form->input('password', [
            'class' => 'form-control input-lg',
            'placeholder' => __('Password'),
            'templateVars' => [
                'divClass' => 'form-group mb-lg',
                'beforeInput' => '<div class="input-group input-group-icon">',
                'afterInput' => '<span class="input-group-addon"><span class="icon icon-lg"><i class="fa fa-lock"></i></span></span></div>'
            ]
        ]);
        ?>


        <div class="row">
            <div class="col-sm-8">
                <div class="checkbox-custom checkbox-default">
                    <input type="checkbox" name="rememberme" id="RememberMe">
                    <label for="RememberMe"><?=('Remember Me')?></label>
                </div>
            </div>
            <div class="col-sm-4 text-right">
                <?= $this->Form->button(__('Sign In'), ['class' => 'btn btn-primary hidden-xs']) ?>
                <?= $this->Form->button(__('Sign In'), ['class' => 'btn btn-primary btn-block btn-lg visible-xs mt-lg']) ?>
            </div>
        </div>

        <span class="mt-lg mb-lg line-thru text-center text-uppercase">
            <span><?=__('or')?></span>
        </span>

        
        <p class="text-center"><?=__('Cant remember your password?')?> <?= $this->Html->link(__('Reset Password!'),['controller' => 'Users', 'action' => 'reset_password'] ); ?></p>
        <p class="text-center"><?=__('Haven\'t gotten the activation email yet?')?> <?= $this->Html->link(__('Resend Activation Email!'),['controller' => 'Users', 'action' => 'sendActivtionEmail'] ); ?></p>
        <p class="text-center"><?=__('Don\'t have an account yet?')?> <?= $this->Html->link(__('Sign Up'),['controller' => 'Users', 'action' => 'signup'] ); ?></p>
        <?= $this->Form->end() ?>
    </div>
</div>