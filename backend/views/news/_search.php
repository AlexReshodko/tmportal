<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'author_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'thumbnail') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
