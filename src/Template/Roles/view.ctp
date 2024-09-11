

<div class="roles view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($role->title) ?></h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($role->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Title') ?></th>
                            <td><?= h($role->title) ?></td>
                        </tr>


                        <tr>
                            <th><?= __('Description') ?></th>
                            <td><?= $this->Text->autoParagraph(h($role->description)); ?></td>
                        </tr>
                        <?php if($this->Permission->hasPermission('roles.viewpermissions')){ ?>
                        <tr>
                            <th><?= __('Permissions') ?></th>
                            <td>
                                <?php
                                $currentPerms = (!empty($role['permissions']) ? json_decode($role['permissions']) : []);
                                $permissions_list = \Cake\Core\Configure::read('permissions');

                                foreach ($permissions_list as $perHead => $perDetail) {
                                    ?>

                                    <div class="input select  col-sm-12 mb-lg">
                                        <strong><?= __($perHead) ?></strong>
                                        <ul>
                                        <?php foreach ($perDetail as $pval => $pkey) { ?>
                                            <li><?= $pkey ?> : <?= (in_array($pval, $currentPerms) ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>') ?></li>
                                        <?php } ?>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($role->modified) ?></td>
                        </tr>


                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($role->created) ?></td>
                        </tr>
                    </table>

                </div>
            </section>
        </div>
    </div>                    



    <?php if($this->Permission->hasPermission('users.view')){ ?>
    <div class="related">

        <div>
            <div class="col-md-12">
                <section class="panel panel-info">
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>

                        <h2 class="panel-title"><?= __('Related Users') ?></h2>
                    </header>
                    <div class="panel-body">
                        <?php if (!empty($role->users)): ?>
                            <table cellpadding="0" cellspacing="0" class='table table-hover table-bordered table-striped'>
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Username') ?></th>
                                    <th><?= __('Email') ?></th>
                                    <th><?= __('First Name') ?></th>
                                    <th><?= __('Last Name') ?></th>
                                    <th><?= __('Phone') ?></th>
                                </tr>
                                <?php foreach ($role->users as $users): ?>
                                    <tr>
                                        <td><?= h($users->id) ?></td>
                                        <td><?= h($users->username) ?></td>
                                        <td><?= h($users->email) ?></td>
                                        <td><?= h($users->first_name) ?></td>
                                        <td><?= h($users->last_name) ?></td>
                                        <td><?= h($users->phone) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>                    
    </div>
    <?php } ?>
</div>
