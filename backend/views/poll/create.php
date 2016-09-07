<?php

use yii\helpers\Html;
use common\widgets\CreateUpdateWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Poll */

$this->title = Yii::t('app', 'Create Poll');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-create">
    <?= CreateUpdateWidget::widget([
        'params' => [
            'title' => Html::encode($this->title),
            'view' => 'poll',
            'viewParams' => [
                'modelPoll' => $modelPoll,
                'modelsPollValue' => (empty($modelsPollValue)) ? [new PollValue] : $modelsPollValue
            ]
        ]
    ])?>
</div>
