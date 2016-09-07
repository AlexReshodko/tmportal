<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyEvent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-event-form form-horizontal">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


        <?= $form->field($model, 'date')->input('date'); ?>

        <?= $form->field($model, 'thumbnail')->fileInput(['maxlength' => true, 'class' => 'file-input']) ?>
    

        <div class="checkbox checkbox-switch">
            <?= $form->field($model, 'status')->checkbox([
                'class' => 'switch',
                'data-on-color' => "success",
                'data-off-color' => "danger",
                'data-on-text' => Yii::t('status', "Active"),
                'data-off-text' => Yii::t('status', "Disabled"),
            ], false)->label(false)?>
        </div>

        <div class="form-group text-center">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-xlg' : 'btn btn-primary btn-xlg']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>