<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];
$yesNo = ['No', 'Yes'];

/**
 * Checks if a string is contained in another string
 * @param type $needle  What to search for
 * @param type $haystack    What to search in
 * @return boolean
 */
function contains($needle, $haystack) {
    if (strpos($haystack, $needle) !== false) {
        return true;
    } else {
        return false;
    }
}
?>
<div class="users index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Users') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create(null, ['type' => 'get', 'url' => '?page=1']) ?>
                    <div class="col-md-6">
                        <div class="input-group mb-md">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="search" name="search_term" id="search_term" placeholder="<?= __('Enter your search term') ?>" class="form-control" value="<?= (isset($_REQUEST['search_term']) ? $_REQUEST['search_term'] : '') ?>">
                        </div>    
                    </div>

                    <?php
                    echo $this->Form->input('role_id', [
                        'options' => $roles,
                        'empty' => 'Any Role',
                        'label' => false,
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-3 mb-lg']
                    ]);
                    echo $this->Form->input('user_registered', [
                        'options' => ['Unregistered User', 'Registered Users'],
                        'empty' => 'Any Registered',
                        'label' => false,
                        'class' => 'form-control input-md',
                        'templateVars' => ['divClass' => 'col-sm-3 mb-lg']
                    ]);

                    echo $this->Form->button(__('Preform Search'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->input('a', ['type' => 'hidden', 'value' => 'search']);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>


            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Users') ?> <small>(<?= $count ?> records found)</small></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!--div class="mb-md">
                            <?= $this->Html->link(__('New User <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div-->
                        </div>
                    </div>
                    <div class="_table-responsive">
                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                                <thead>
                                    <tr>
                                        <th><?= $this->Paginator->sort('id') ?></th>
                                        <th><?= $this->Paginator->sort('username') ?></th>
                                        <th><?= $this->Paginator->sort('email') ?></th>
                                        <th><?= $this->Paginator->sort('first_name') ?></th>
                                        <th><?= $this->Paginator->sort('last_name') ?></th>
                                        <th><?= $this->Paginator->sort('phone') ?></th>
                                        <th><?= $this->Paginator->sort('role_id') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <?php
                                        /** @var \App\Model\Entity\User $user */
                                        $rowClass = '';
                                        if (!$user->user_registered) {
                                            $rowClass = 'warning';
                                        } elseif ($user->is_active == 0 || $user->is_locked == 1) {
                                            $rowClass = 'danger';
                                        } else {
                                            
                                        }
                                        ?>
                                        <tr class="<?= $rowClass ?>">
                                            <td><?= $this->Number->format($user->id) ?></td>
                                            <td><?= $this->Html->link(h($user->username), ['controller' => 'users', 'action' => 'view', $user->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></td>
                                            <td><?= h($user->email) ?></td>
                                            <td><?= h($user->first_name) ?></td>
                                            <td><?= h($user->last_name) ?></td>
                                            <td><?= h($user->phone) ?></td>
                                            <td>
                                                <?= $this->Html->link(h($user->role->title), ['controller' => 'roles', 'action' => 'view', $user->role->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                                            </td>
                                            <td class="actions">

                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                                    <ul class="dropdown-menu">
                                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['escape' => false]) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['escape' => false]) ?></li>
                                                        <li class="divider"></li>
                                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'escape' => false]) ?></li>

                                                        <?php if ($this->Permission->hasPermission('users.reset-password') || $this->Permission->isAdmin()) { ?>
                                                        <li class="divider"></li>
                                                        <li><?= $this->Html->link(__('Reset Password'), ['action' => 'reset-password', $user->email, $user->activation_code], ['escape' => false, 'target' => '_blank']) ?></li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>                            




    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
