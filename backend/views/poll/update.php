<?php

use yii\helpers\Html;
use common\widgets\CreateUpdateWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Poll */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Poll',
]) . $modelPoll->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelPoll->title, 'url' => ['view', 'id' => $modelPoll->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="poll-update">
    
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
