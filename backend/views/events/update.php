<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyEvents */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Company Events',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="company-events-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
