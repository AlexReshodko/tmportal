<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\assets\LoginAsset;

LoginAsset::register($this);
?>
<!-- Page container -->
<div class="page-container login-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Simple login form -->
                <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{input}\n{hint}\n{error}",
                    ],
                ]);
                ?>

                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <h1 class="panel-title">TestMatick Portal</h1>
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                        <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
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
                </div>
                <?php ActiveForm::end(); ?>
                
                <div class="footer text-muted">
                    &copy; <?= date('Y') ?>. <a href="http://testmatick.com">TestMatick</a>
                </div>
            </div>
        </div>
    </div>
</div>