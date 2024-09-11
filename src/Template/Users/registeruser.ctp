<?php
$this->layout = 'login_signup';
$this->loadHelper('Form', [
    'templates' => 'login_form',
]);
?>

<div class="users form content">
    <div class="panel panel-sign">
        <div class="panel-title-sign mt-xl text-right">
            <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> <?= __('User Sign Up') ?></h2>
        </div>
        <div class="panel-body">
            <?= $this->Form->create($user) ?>

            <div class="form-group mb-none">
                <div class="row">
                    <?php
                    echo $this->Form->input('first_name', [
                        'class' => 'form-control input-lg',
                        'placeholder' => 'First Name',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('last_name', [
                        'class' => 'form-control input-lg',
                        'placeholder' => 'Last Name',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    ?>
                </div>
            </div>
            <?php
            echo $this->Form->input('username', [
                'class' => 'form-control input-lg',
                'placeholder' => 'username',
                'templateVars' => ['divClass' => 'form-group mb-lg']
            ]);

            echo $this->Form->input('phone', [
                'class' => 'form-control input-lg',
                'label' => 'Phone',
                'placeholder' => '(123) 123-1234',
                'data-plugin-masked-input',
                'data-input-mask' => "(999) 999-9999",
                'templateVars' => ['divClass' => 'form-group mb-lg']
            ]);

            echo $this->Form->input('email', [
                'class' => 'form-control input-lg',
                'label' => 'E-mail Address',
                'placeholder' => 'E-mail Address',
                'templateVars' => ['divClass' => 'form-group mb-lg']
            ]);
            ?>

            <div class="form-group mb-none">
                <div class="row">
                    <?php
                    echo $this->Form->input('password', [
                        'class' => 'form-control input-lg',
                        'placeholder' => 'Password',
                        'type' => 'password',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('confirm_password', [
                        'class' => 'form-control input-lg',
                        'type' => 'password',
                        'placeholder' => 'Confirm Password',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <?= $this->Porto->addCheckboxRequired('I agree with the ' . $this->Html->link('terms of use', ['action' => 'terms_of_use', 'controller' => 'pages'], ['target' => '_blank']), 'agreeterms', $user, 'col-sm-8', 'col-md-10', 'col-md-2'); ?>
                <!--- div class="col-sm-8">

                    <div class="checkbox-custom checkbox-default">
                        <input id="AgreeTerms" name="agreeterms" type="checkbox" required="" value="1"/>
                        <label for="AgreeTerms">
                            I agree with <?= $this->Html->link(__('terms of use'), ['action' => 'terms_of_use', 'controller' => 'pages'], ['target' => '_blank']) ?>
                        </label>
                    </div>
                </div--->
                <div class="col-sm-4 text-right">
                    <?= $this->Form->button(__('Sign Up'), ['class' => 'btn btn-primary hidden-xs']) ?>
                    <?= $this->Form->button(__('Sign Up'), ['class' => 'btn btn-primary btn-block btn-lg visible-xs mt-lg']) ?>
                </div>
            </div>

            <?php /*
              <span class="mt-lg mb-lg line-thru text-center text-uppercase">
              <span>or</span>
              </span>

              <div class="mb-xs text-center">
              <a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
              <a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
              </div>
             */ ?>
            <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                <span>or</span>
            </span>
            <p class="text-center">Already have an account? <?= $this->Html->link(__('Sign In!'), ['action' => 'login']) ?></p>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
