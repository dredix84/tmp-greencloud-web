<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

/** @var \App\Service\Address $address */

$emode = (isset($role['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in

$u = &$userinfo;

/**
 * Used to create a checkbox which used the Porto theme layout
 * @param type $displayText Label text
 * @param type $name    Input name
 * @param type $data    Form data
 * @return string
 */
function create_checkbox($displayText, $name, $data) {
    $checked = ($data[$name] == 1 || $data[$name] == true ? ' checked="checked" ' : '');
    return '
        <div class="form-group">
            <label class="col-xs-3 control-label mt-xs pt-none" for="' . $name . '"> ' . __($displayText) . '</label>
            <div class="col-md-8">
                <div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
                    <input type="hidden" name="' . $name . '" value="0">
                    <input type="checkbox" id="' . $name . '" name="' . $name . '" ' . $checked . '  value="1">
                    <label for="' . $name . '"></label>
                </div>
            </div>
        </div>';
}
?>

<div class="row">

    <div class="col-md-12">
        <div class="well info">
            <?= __('This page allows you to modify your personal details and also allows you to specify what notifications you receive.') ?>  
            <?php
            if ($u['role_id'] == 1 && empty($u['address_line_1'])) {
                echo '<br />';
                echo __('Your address is incomplete. Kindly complete your address.');
            }
            ?>
        </div>

        <br />
        <br />       
    </div>


    <div class="col-md-4 col-lg-3">

        <section class="panel">
            <div class="panel-body">
                <div class="thumb-info mb-md">
                    <img alt="John Doe" class="rounded img-responsive" src="<?= WEBROOT ?>assets/images/!logged-user.jpg">
                    <div class="thumb-info-title">
                        <span class="thumb-info-inner"><?= $u['first_name'] ?> <?= $u['last_name'] ?></span>
                        <span class="thumb-info-type"><?= $u['role']['title'] ?></span>
                    </div>
                </div>

                <p>Account Created:<br /><?= $u['created'] ?></p>
                <hr class="dotted short">

                <?php if (isset($receiptCount)) { ?>
                    <p>Receipt Count: <?= $receiptCount ?></p>
                    <hr class="dotted short">
                <?php } ?>

                <h6 class="text-muted">About Me</h6>
                <p>You have a <?= $u['role']['title'] ?> account.</p>

                <?php if ($u['role']['id'] == 2 && isset($u['merchant']['name'])) { ?>
                    <p>You have a merchant account and currently viewing the <?= $u['merchant']['name'] ?> account.</p>
                <?php } elseif ($u['role']['id'] == 3) { ?>
                    <p>Your provider account is setup to work with <strong><?= $u['provider']['name'] ?></strong> account.</p>
                <?php } ?>

                <hr class="dotted short">
            </div>
        </section>
    </div>

    <div class="col-md-12 col-lg-9">
        <?= $this->Form->create($user) ?>

        <div class="tabs">
            <ul class="nav nav-tabs tabs-primary">
                <li class="active">
                    <a href="#overview" data-toggle="tab">Overview</a>
                </li>
                <li>
                    <a href="#notifictions" data-toggle="tab">Notification</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="overview" class="tab-pane active">
                    <h4 class="mb-md"><?= __('General Details') ?></h4>

                    <fieldset>
                        <?php
                        echo $this->Form->input('username', [
                            'class' => 'form-control input-md',
                            'placeholder' => __('Username'),
                            'disabled',
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
                            'placeholder' => '(123) 123-1234',
                            'data-plugin-masked-input',
                            'data-input-mask' => "(999) 999-9999",
                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                        ]);

                        echo $this->Form->button(__('Update Profile'), [
                            'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                            'templateVars' => ['divClass' => 'col-sm-12']
                        ]);
                        ?>
                    </fieldset>

                    <hr class="dotted tall">

                    <h4 class="mb-md"><?= __('Address') ?></h4>
                    <fieldset>
                        <?php
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
                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
							'default' => $address->getCity()
                        ]);
                        echo $this->Form->input('parish_state', [
                            'class' => 'form-control input-md',
                            'placeholder' => __('Parish/State/Province'),
                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
							'default' => $address->getRegion()
                        ]);
                        echo $this->Form->input('country_id', [
                            'class' => 'form-control input-md',
                            'empty' => __('Country'),
                            'templateVars' => ['divClass' => 'col-sm-12 mb-lg'],
							'default' => $address->getCountryId()
                        ]);

                        echo $this->Form->button(__('Update Profile'), [
                            'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                            'templateVars' => ['divClass' => 'col-sm-12']
                        ]);
                        ?>
                    </fieldset>
                </div>
                <div id="notifictions" class="tab-pane">

                    <form class="form-horizontal" method="get">
                        <p>Add a check to the notifications you would like to receive.</p>
                        <fieldset>

                            <?= $this->Porto->addCheckbox('Send new receipt email', 'new_receipt_notification', $user, 'col-md-12', 'col-md-6', 'col-md-6'); ?>

                            <?= $this->Porto->addCheckbox('Send monthly summary', 'monthly_summary_notification', $user, 'col-md-12', 'col-md-6', 'col-md-6'); ?>

                            <?php
                            echo $this->Form->button(__('Update Profile'), [
                                'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                                'templateVars' => ['divClass' => 'col-sm-12']
                            ]);
                            ?>

                        </fieldset>

                    </form>

                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
