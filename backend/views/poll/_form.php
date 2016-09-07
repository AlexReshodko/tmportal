<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Poll */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="poll-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="checkbox checkbox-switch">
        <?= $form->field($modelPoll, 'active')->checkbox([
            'class' => 'switch',
            'data-on-color' => "success",
            'data-off-color' => "danger",
            'data-on-text' => "Yes",
            'data-off-text' => "No"
        ])?>
    </div>
    
    <?= $form->field($modelPoll, 'title')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 1,
        ],
        'preset' => 'basic',
    ]) ?>

    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsPollValue[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'value',
        ],
    ]);
    ?>
    <div class="row">
        <div class="col-md-1">
            <h4><i class="glyphicon glyphicon-envelope"></i> Poll values</h4>
        </div>
        <div class="col-md-1">
            <h4><button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button></h4>
        </div>
    </div>

    <div class="container-items"><!-- widgetContainer -->
        <?php foreach ($modelsPollValue as $i => $modelPollValue): ?>
                <div class="item row"><!-- widgetBody -->
                    <div class="col-md-5">
                        <?php
                        // necessary for update action.
                        if (!$modelPollValue->isNewRecord) {
                            echo Html::activeHiddenInput($modelPollValue, "[{$i}]id");
                        }
                        ?>
                        <?= $form->field($modelPollValue, "[{$i}]value")->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-2 form-group">
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
    <?php DynamicFormWidget::end(); ?>
    
    <div class="form-group">
        <?= Html::submitButton($modelPollValue->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
