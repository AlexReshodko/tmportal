<?php
use yii\helpers\Html;
if(Yii::$app->id == 'app-backend'){
    $bundle = \backend\assets\AppAsset::register($this);
}else{
    $bundle = frontend\assets\AppAsset::register($this);
}

foreach ($items as $item):?>

    <li>
        <?= Html::a(
            Html::img($bundle->baseUrl.'/images/flags/' . $item['url']['language'] . '.png', ['class'=>'position-left']).$item['label'],
            $item['url']
        ) ?>
    </li>

<?php endforeach;?>