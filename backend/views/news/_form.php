<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text_preview')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 1,
        ],
        'preset' => 'basic',
    ]) ?>
    
    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 6,
        ],
        'preset' => 'standard',
    ]) ?>

    <?= $form->field($model, 'date')->input('date', ['value'=>date('Y-m-d')]) ?>


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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
