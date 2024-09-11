

<div class="users view large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($user->username) ?></h2>
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
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('First Name') ?></th>
                            <td><?= h($user->first_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Last Name') ?></th>
                            <td><?= h($user->last_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Phone') ?></th>
                            <td><?= h($user->phone) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Role (User Type)') ?></th>
                            <td><?= $user->has('role') ? $user->role->title : 'No Role' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Merchant') ?></th>
                            <td><?= $user->has('merchant') ? $this->Html->link($user->merchant->name, ['controller' => 'Merchants', 'action' => 'view', $user->merchant->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Provider') ?></th>
                            <td><?= $user->has('provider') ? $this->Html->link($user->provider->name, ['controller' => 'Providers', 'action' => 'view', $user->provider->id]) : '' ?></td>
                        </tr>
                        <?php if (isset($receiptCnt)) { ?>
                            <tr>
                                <th><?= __('Receipt Count') ?></th>
                                <td><span class="label label-success"><?= $receiptCnt ?></span></td>
                            </tr>
                        <?php } ?>
                        <?php if (isset($customerLoyalty)) { ?>
                            <tr>
                                <th><?= __('Total Loyalty') ?></th>
                                <td>$<?= $customerLoyalty ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <th><?= __('Address') ?></th>
                            <td>
                                <?php
                                $address = [
                                    $user->address_line_1,
                                    $user->address_line_2,
                                    $user->city,
                                    $user->parish_state,
                                ];
                                if ($user->has('country')) {
                                    $address[] = $user->country->title;
                                }
                                $address = array_filter($address);
                                echo implode(', ', $address);
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <th><?= __('Last Login') ?></th>
                            <td><?= h($user->last_login) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($user->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($user->modified) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Register Date') ?></th>
                            <td><?= h($user->register_date) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Is Active') ?></th>
                            <td><?= $user->is_active ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Is Locked') ?></th>
                            <td><?= $user->is_locked ? '<span class="label label-danger">Yes</span>' : '<span class="label label-success">No</span>'; ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Activated') ?></th>
                            <td><?= $user->activated ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                        </tr>
                        <tr>
                            <th><?= __('User Registered') ?></th>
                            <td><?= $user->user_registered ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                        </tr>
                        <tr>
                            <th><?= __('New Receipt Notification') ?></th>
                            <td><?= $user->new_receipt_notification ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Monthly Summary Notification') ?></th>
                            <td><?= $user->monthly_summary_notification ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                        </tr>

                    </table>

                </div>
            </section>
        </div>
    </div> 


    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                    </div>

                    <h2 class="panel-title">Merchant Accounts</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Business Name</th>
                                <th class="text-right">Active</th>
                                <th class="text-right">Locked</th>
                                <th>Created</th>
                                <th class="text-right">Receipts</th>
                                <th class="text-right">Credits Purchased</th>
                                <th class="text-right">Credits Used</th>
                                <th class="text-right">Credits Remaining</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user->merchant_accounts as $ma) { ?>
                                <?php
                                    /** @var \App\Model\Entity\Merchant $ma */
                                ?>
                                <tr>
                                    <td data-title="ID"><?= $ma->id ?></td>
                                    <td data-title="Business Name">
                                        <?= $this->Html->link($ma->business_title, ['controller' => 'Merchants', 'action' => 'view', $ma->id], ['class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                                    </td>
                                    <td data-title="Active" class="text-right"><?= $ma->is_active ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';  ?></td>
                                    <td data-title="Created" class="text-right"><?= $ma->is_locked ? '<span class="label label-danger">Yes</span>' : '<span class="label label-success">No</span>';  ?></td>
                                    <td data-title="Created" class="text-right"><?= $ma->created ?></td>
                                    <td data-title="Receipts" class="text-right"><?= $ma->receipt_count ?></td>
                                    <td data-title="Credit Purchased" class="text-right"><?= $ma->credits_purchased ?></td>
                                    <td data-title="Credit Used" class="text-right"><?= $ma->credits_used ?></td>

                                    <td data-title="Credit Remaining" class="text-right">
                                        <?php 
                                        $creditRemaining = $ma->credits_remaining;
                                        echo ($creditRemaining <= $ma->low_credit_alert_amount ? "<span class=\"label label-danger\">$creditRemaining</span>" : $creditRemaining);
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
