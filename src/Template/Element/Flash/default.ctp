<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="alert alert-info <?= h($class) ?>">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <?= h($message) ?>
</div>
