<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];

use App\Model\Entity\Merchant; ?>
<div class="merchants index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">


            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                    </div>

                    <h2 class="panel-title">About this page</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class=""><?= __('This page shows you all your current merchant accounts and allows you to create more merchant accounts.') ?></p>
                            <p class=""><?= __('Please note that credits are tracked separately for each merchant account.') ?></p>
                            <?= $this->Html->link(__('Setup Additional Merchant Account'), ['controller' => 'merchants', 'action' => 'add', $userinfo['merchant']['id']], ['class' => 'btn btn-success modalbox right', 'escape' => false, 'data-ajaxlink' => "#modalbox", 'data-title' => __('Setup Additional Merchant Account')]); ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Merchants') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create(null, ['type' => 'get']) ?>
                    <div class="col-md-6">
                        <div class="input-group mb-md">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="search" name="search_term" id="search_term" placeholder="<?= __('Enter your search term') ?>" class="form-control">
                        </div>
                    </div>

                    <?php
                    echo $this->Form->button(__('Preform Search'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->input('a', ['type' => 'hidden', 'value' => 'search']);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>

        </div>
    </div>

    <div class="row">
        <?php
        $class_num = (count($merchants) > 1 ? 6 : 12);
        ?>
        <?php foreach ($merchants as $merchant):
            /** @var Merchant $merchant */

            $address = [
                h($merchant->city),
                h($merchant->state)
            ];
            $address = array_filter($address);

            $isactive = ($merchant->is_active == 0 || $merchant->deleted == 1) ? FALSE : TRUE;

            $colorClass = $userinfo['merchant_id'] == $merchant->id ? 'success' : 'primary';
            if (!$isactive) {
                $colorClass = 'secondary';
            }
            ?>
            <div class="col-md-<?= $class_num ?>">
                <section class="hidden-md panel panel-featured-left panel-featured-<?= $colorClass ?>">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-xlg">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-<?= $colorClass ?>">
                                    <i class="fa fa-building"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">
                                        <?= $this->Html->link(h($merchant->business_title), ['action' => 'view', $merchant->id], ['escape' => false, 'class' => 'modalbox text-muted text-uppercase', 'data-ajaxlink' => '#modalbox']) ?>
                                        <br />
                                        <small>
                                            (<?= $merchant->has('industry') ? $merchant->industry->title : ' - ' ?>)
                                            (<?= $merchant->currency ?>)
                                        </small>
                                    </h4>
                                    <div class="info">
                                        <strong><?= h($merchant->contact_name) ?></strong>
                                        <span class="text-primary">(<?= h($merchant->contact_phone) ?>)</span>
                                    </div>
                                    <?php if (!$isactive) { ?>
                                        <span class="label label-danger"><?= __('This merchant account is not active.') ?> <?= $merchant->deactivate_note ?></span>
                                    <?php } else if ($colorClass == 'success') { ?>
                                        <span class="label label-success"><?= __('You are currently using this merchant account.') ?></span>
                                    <?php } else { ?>
                                        <span class="label label-primary">-----</span>
                                    <?php } ?>
                                    <br />

                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-<?= $colorClass ?> dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                        <ul class="dropdown-menu">
                                            <li><?= $this->Html->link(__('View'), ['action' => 'view', $merchant->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                            <?php if ($isactive) { ?><li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $merchant->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li><?php } ?>
                                            <li class="divider"></li>
                                            <li><?= $this->Html->link(__('Swtich To'), ['action' => 'switchTo', $merchant->id], ['escape' => false]) ?></li>
                                            <?php if ($isactive || true) { ?>
                                                <li class="divider"></li>
                                                <li><?= $this->Html->link(__('Deactivate account'), ['action' => 'deactivate', $merchant->id], ['escape' => false, 'class' => '', 'confirm' => __('Are you sure you want to deactivate this account? \nOnce deactivated, you will no longer be able to post transactions to this merchant account. \nAccount name: ') . $merchant->business_title]) ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <?= $this->Html->link(__('(View Details)'), ['action' => 'view', $merchant->id], ['escape' => false, 'class' => 'modalbox text-muted text-uppercase', 'data-ajaxlink' => '#modalbox']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev(__('previous'), ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next'), ['escape' => false]) ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
