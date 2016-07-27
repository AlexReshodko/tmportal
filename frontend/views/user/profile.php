<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\AvatarHelper;

/* @var $this View */

$this->title = 'User Profile';
$this->params['breadcrumbs'][] = $this->title;
$bundle = AppAsset::register($this);
?>
<div class="user-data-index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card card-user">
                    <div class="image">
                        <img src="<?= $bundle->baseUrl ?>/images/background.jpg" alt="..."/>
                    </div>
                    <div class="content">
                        <div class="author">
                            <div class="avatar border-white" style="background-image:url(<?= AvatarHelper::getAvatarUrl($userData->photo) ?>)">
                                <div class="icon-big icon-info text-center upload-icon"><i class="ti-upload"></i></div>
                                <input type="file" id="photo" name="photo" accept=".jpg,.jpeg" style="display: none;">
                            </div>
                            <h4 class="title"><?= $userData->first_name ?> <?= $userData->last_name ?><br />
                                <!--<a href="#"><small>@chetfaker</small></a>-->
                            </h4>
                        </div>
                        <p class="description text-center">
                            <?= $userData->comment ?>
                        </p>
                    </div>
                    <hr>
<!--                    <div class="text-center">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <h5>12<br /><small>Files</small></h5>
                            </div>
                            <div class="col-md-4">
                                <h5>2GB<br /><small>Used</small></h5>
                            </div>
                            <div class="col-md-3">
                                <h5>24,6$<br /><small>Spent</small></h5>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                        <div class="col-md-6">
                            <?= $form->field($userData, 'first_name')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userData, 'last_name')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userData, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userData, 'skype')->textInput(['maxlength' => true, 'class' => 'form-control border-input']) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $form->field($userData, 'comment')->textarea(['rows' => 6, 'class' => 'form-control border-input']) ?>
                        </div>

                        <div class="form-group text-center">
                            <?= Html::submitButton($user->isNewRecord ? 'Create' : 'Update', ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.upload-icon').on('click', function () {
        $('#photo').click();
    })
    $('#photo').on('change', function () {
        console.log('here');
        var data = new FormData();
        data.append('photo', this.files[0]);
        console.log(this.files[0]);
        $.ajax({
            url: "upload-photo",
            type: "POST",
            data: data,
            processData: false, // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success : function (data) {
                console.log('!!!');
                console.log(data);
                if(data){
                    window.location.reload();
                }
            }
        });
    });
</script>
