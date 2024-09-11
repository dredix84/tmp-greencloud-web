<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($role['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in
$coloredYesNo = Cake\Core\Configure::read('coloredYesNo');
?>




<div class="users form large-9 medium-8 columns content">
    <div class="row">

        <div class="col-md-12">
            <section class="panel panel-featured panel-featured-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                    </div>

                    <h2 class="panel-title">User Information</h2>
                </header>
                <div class="panel-body">
                    <table class="vertical-table table table-hover">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($user->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Full name') ?></th>
                            <td><?= h($user->full_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= $this->Text->autoLinkEmails($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Registed') ?></th>
                            <td><?= $coloredYesNo[$user->user_registered] ?> <?php if($user->user_registered){ ?>(<?= h($user->register_date) ?>)<?php } ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Activation Link') ?></th>
                            <td>
                                <?php
                                $alink =  WEBROOT . "users/doactivate/" . $user->email . "/" . $user->activation_code;
                                ?>
                                <a class="btn btn-warning btn-sm" href="<?=$alink?>" target="_blank">Click here to activate as the user would</a>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($user->created) ?></td>
                        </tr>
                    </table>
                </div>
            </section>
        </div>

        <div class="col-md-12">
            <section class = "panel panel-primary">
                <header class = "panel-heading">
                    <div class = "panel-actions">
                        <a data-panel-toggle = "" class = "panel-action panel-action-toggle" href = "#"></a>
                        <a data-panel-dismiss = "" class = "panel-action panel-action-dismiss" href = "#"></a>
                    </div>

                    <h2 class = "panel-title"><?= __('Edit User') ?></h2>
                </header>
                <div class = "panel-body">


                    <?= $this->Form->create($user) ?>
                    <?php
                    echo $this->Form->input('username', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Username'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('email', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Email'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('first_name', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('First Name'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('last_name', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Last Name'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('phone', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Phone'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    /*echo $this->Form->input('merchant_signup', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Merchant Signup'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);*/
                    echo $this->Form->input('merchant_id', [
                        'options' => $merchants,
                        'empty' => true,
                        'class' => 'form-control input-md',
                        'empty' => __('Default Merchant Account'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('provider_id', [
                        'options' => $providers,
                        'empty' => true,
                        'class' => 'form-control input-md',
                        'empty' => __('Provider Account'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Porto->addHr('dotted', 'col-md-12');
                    echo $this->Porto->addHeader('Activation & Locks', 3, 'col-md-12');

                    echo $this->Form->input('is_active', [
                        'class' => 'form-control input-md',
                        'options' => ['No', 'Yes'],
                        'placeholder' => __('Is Active'),
                        'templateVars' => ['divClass' => 'col-sm-4 mb-lg']
                    ]);
                    echo $this->Form->input('is_locked', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Is Locked'),
                        'options' => ['No', 'Yes'],
                        'templateVars' => ['divClass' => 'col-sm-4 mb-lg']
                    ]);
                    echo $this->Form->input('user_registered', [
                        'class' => 'form-control input-md',
                        'options' => ['No', 'Yes'],
                        'disabled',
                        'templateVars' => ['divClass' => 'col-sm-4 mb-lg']
                    ]);
                    echo $this->Form->input('activated', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Activated'),
                        'options' => ['No', 'Yes'],
                        'templateVars' => ['divClass' => 'col-sm-4 mb-lg']
                    ]);
                    echo $this->Form->input('activation_code', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Activation Code'),
                        'readonly',
                        'templateVars' => ['divClass' => 'col-sm-8 mb-lg']
                    ]);


                    echo $this->Porto->addHr('dotted', 'col-md-12');
                    echo $this->Porto->addHeader('Address', 3, 'col-md-12');

                    echo $this->Form->input('address_line_1', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Address Line 1'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);

                    echo $this->Form->input('address_line_2', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Address Line 2'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);

                    echo $this->Form->input('city', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('City'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('parish_state', [
                        'class' => 'form-control input-md',
                        'placeholder' => __('Parish/Province/State'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('country_id', [
                        'class' => 'form-control input-md',
                        'empty' => __('No country selected'),
                        'options' => $countries,
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    
                    echo $this->Porto->addHr('dotted', 'col-md-12');
                    echo $this->Porto->addHeader('Note', 3, 'col-md-12');
                    echo $this->Porto->addAlert('Notes added in the field below is not shown to the user.', 'info', false, 'col-md-12');

                    echo $this->Form->input('admin_note', [
                        'class' => 'form-control input-md',
                        'label' => false,
                        'placeholder' => __('Notes added here are not shown to the user.'),
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
