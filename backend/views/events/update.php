<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyEvent */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Company Events',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="company-events-update">
    <?= common\widgets\CreateUpdateWidget::widget([
        'params' => [
            'title' => Html::encode($this->title),
            'view' => 'events',
            'viewParams' => [
                'model' => $model,
            ]
        ]
    ])?>
</div>
