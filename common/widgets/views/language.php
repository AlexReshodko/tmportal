<?php use yii\helpers\Html;?>
<?php foreach ($items as $item):?>
    <li><?= Html::a($item['label'], $item['url']) ?></li>
<?php endforeach;?>