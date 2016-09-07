<?php

use yii\helpers\Html;
use common\widgets\CreateUpdateWidget;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'News',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="news-update">

    <?= CreateUpdateWidget::widget([
        'params' => [
            'title' => Html::encode($this->title),
            'view' => 'news',
            'viewParams' => [
                'model' => $model,
            ]
        ]
    ])?>

</div>
