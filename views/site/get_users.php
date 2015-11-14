<?php
use yii\helpers\Html;
?>
<div class="result">
<div class="head-box"><div style="padding-left: 5px">Users</div></div>
<?php foreach ($users as $val): ?>
<div><?= Html::encode("{$val['lastname']} {$val['firstname']} ({$val['login']}) : ({$val['role']})") ?></div>
<?php endforeach; ?>
</div>