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
        return $schema->columnType($field) !== 'binary';
    });

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

$emode = (isset($<%= $singularVar %>['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
<% /*
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
<% if (strpos($action, 'add') === false): %>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $<%= $singularVar %>-><%= $primaryKey[0] %>],
                ['confirm' => __('Are you sure you want to delete # {0}?', $<%= $singularVar %>-><%= $primaryKey[0] %>)]
            )
        ?></li>
<% endif; %>
        <li><?= $this->Html->link(__('List <%= $pluralHumanName %>'), ['action' => 'index']) ?></li>
<%
        $done = [];
        foreach ($associations as $type => $data) {
            foreach ($data as $alias => $details) {
                if ($details['controller'] !== $this->name && !in_array($details['controller'], $done)) {
%>
        <li><?= $this->Html->link(__('List <%= $this->_pluralHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'index']) %></li>
        <li><?= $this->Html->link(__('New <%= $this->_singularHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'add']) %></li>
<%
                    $done[] = $details['controller'];
                }
            }
        }
%>
    </ul>
</nav>
*/ %>    
        
 
<div class="<%= $pluralVar %> form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' <%= $singularHumanName %>'); /* <%= Inflector::humanize($action) %> */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($<%= $singularVar %>) ?>
        <?php
<%
        foreach ($fields as $field) {
            if (in_array($field, $primaryKey)) {
                continue;
            }
            if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
%>
            echo $this->Form->input('<%= $field %>', [
                'options' => $<%= $keyFields[$field] %>, 
                'empty' => true,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
<%
                } else {
%>
            echo $this->Form->input('<%= $field %>', [
                'options' => $<%= $keyFields[$field] %>
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
<%
                }
                continue;
            }
            if(strpos($field, '_id') !== false){
%>
            echo $this->Form->input('<%= $field %>', [
                    'class' => 'form-control input-md',
                    'empty' => __('Select <%= ucwords(str_replace(['_id', '_'], ['',' '], $field)) %> ...'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
<%
            }elseif (!in_array($field, ['created', 'modified', 'updated', 'created_by', 'modified_by'])) {
                $fieldData = $schema->column($field);
                if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
%>
            echo $this->Form->input('<%= $field %>', ['empty' => true]);
<%
                } else {
%>
            echo $this->Form->input('<%= $field %>', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('<%= ucwords(str_replace('_', ' ', $field)) %>'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
<%
                }
            }
        }
        if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
%>
            echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
<%
            }
        }
%>
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

<script>
/*$(function() {

});*/
</script>