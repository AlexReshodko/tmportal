<?php

use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'class' => 'file-input']) ?>

<button>Submit</button>

<?php ActiveForm::end() ?>