<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<!-- Simple login form -->
<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => "{input}\n{hint}\n{error}",
    ],
]);
?>

<div class="text-center">
    <h1 class="panel-title"><?=Yii::$app->name?></h1>
    <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
    <h5 class="content-group"><?= Yii::t('login-page', 'Login to your account')?> <small class="display-block"><?= Yii::t('login-page', 'Enter your credentials below')?></small></h5>
</div>

<div class="form-group has-feedback has-feedback-left">
    <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username']) ?>
    <div class="form-control-feedback">
        <i class="icon-user text-muted"></i>
    </div>
</div>

<div class="form-group has-feedback has-feedback-left">
    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password']) ?>
    <div class="form-control-feedback">
        <i class="icon-lock2 text-muted"></i>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Login<i class="icon-circle-right2 position-right"></i>', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
</div>
<div class="text-center">
    <?= Html::a('Forgot password?', ['site/request-password-reset']) ?>
</div>
<?php ActiveForm::end(); ?>