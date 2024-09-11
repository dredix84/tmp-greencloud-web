<%
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.1.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/
use Cake\Utility\Inflector;

$fields = collection($fields)
->filter(function($field) use ($schema) {
return !in_array($schema->columnType($field), ['binary', 'text']);
})
->take(7);

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
$fields = $fields->reject(function ($field) {
return $field === 'lft' || $field === 'rght';
});
}
%>
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$count = $this->Paginator->params()['count'];
?>
<div class="<%= $pluralVar %> index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?=__('Search'); ?> <?= __('<%= $pluralHumanName %>') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create(null, ['type' => 'get']) ?>
                    <div class="col-md-6">
                        <div class="input-group mb-md">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="search" name="search_term" id="search_term" placeholder="<?= __('Enter your search term...') ?>" class="form-control">
                        </div>    
                    </div>
                    
                    <?php

                    echo $this->Form->button(__('Preform Search'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->input('a', ['type' => 'hidden', 'value'=>'search']);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>


            <section class="panel panel-primary panel-data">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('<%= $pluralHumanName %>') ?> <small>(<?=$count?> <?= $count==1?__('Record found'):__('Records found')?> )</small></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-md">
                                <?= $this->Html->link(__('New <%= $singularHumanName %> <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class'=>'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="_table-responsive">

                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                            <thead>
                                <tr>
                                    <% foreach ($fields as $field): %>
                                    <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
                                    <% endforeach; %>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
                                <tr>
                                    <%        foreach ($fields as $field) {
                                    $tdAttr = ($field=='title'?" data-title='$field' ":'');
                                    $isKey = false;
                                    if (!empty($associations['BelongsTo'])) {
                                    foreach ($associations['BelongsTo'] as $alias => $details) {
                                    if ($field === $details['foreignKey']) {
                                    $isKey = true;
                                    %>
                                    <td<%= $tdAttr %>><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
                                    <%
                                    break;
                                    }
                                    }
                                    }
                                    if ($isKey !== true) {
                                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                                    %>
                                    <td<%= $tdAttr %>><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                                    <%
                                    } else {
                                    %>
                                    <td<%= $tdAttr %>><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                                    <%
                                    }
                                    }
                                    }

                                    $pk = '$' . $singularVar . '->' . $primaryKey[0];
                                    %>
                                    <td class="actions">
                                        
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary dropdown-toggle" type="button"> Actions <span class="caret"></span> </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>], ['escape'=>false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>], ['escape'=>false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></li>
                                                <li class="divider"></li>
                                                <li><?= $this->Html->link(__('Delete'), ['action' => 'delete', <%= $pk %>], ['escape'=>false, 'class'=>'ajaxrowdelete']) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>                            




    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev(__('previous'), ['escape'=>false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next'), ['escape'=>false]) ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
