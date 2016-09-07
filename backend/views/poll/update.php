<?php

use yii\helpers\Html;

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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelPoll' => $modelPoll,
        'modelsPollValue' => (empty($modelsPollValue)) ? [new PollValue] : $modelsPollValue
    ]) ?>

</div>
