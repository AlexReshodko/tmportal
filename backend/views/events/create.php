<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CompanyEvents */

$this->title = Yii::t('app', 'Create Company Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-events-create">
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
