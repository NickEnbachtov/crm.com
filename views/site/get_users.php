<?php
use yii\helpers\Html;
?>
<div class="result">
<div class="head-box"><div style="padding-left: 5px">Users<div style="float: right;padding-right: 5px;"><span title="shown">10</span> (<span title="all"><?= $amount ?></span>)</div></div></div>
<?php foreach ($users as $val): ?>
<div><?= Html::encode("{$val['lastname']} {$val['firstname']}") ?> (<span class="span_link user_card" data-id="<?= $val['id'] ?>" id="<?= $val['user_card'] ?>"><?= Html::encode("{$val['login']}") ?></span>) : <?= Html::encode("({$val['role']})") ?></div>
<?php endforeach; ?>
</div>