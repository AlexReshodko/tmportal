<?php

use yii\helpers\Html;
use common\widgets\CreateUpdateWidget;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyEvent */

$this->title = Yii::t('app', 'Create Company Event');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-events-create">
    <?= CreateUpdateWidget::widget([
        'params' => [
            'title' => Html::encode($this->title),
            'view' => 'events',
            'viewParams' => [
                'model' => $model,
            ]
        ]
    ])?>
</div>
