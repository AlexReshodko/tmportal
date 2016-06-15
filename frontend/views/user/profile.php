<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                        <img src="<?=$bundle->baseUrl?>/images/background.jpg" alt="..."/>
                    </div>
                    <div class="content">
                        <div class="author">
                            <div class="avatar border-white" style="background-image:url(<?=$userData->photo?>)"></div>
                            <h4 class="title"><?=$userData->first_name?> <?=$userData->last_name?><br />
                                <!--<a href="#"><small>@chetfaker</small></a>-->
                            </h4>
                        </div>
                        <p class="description text-center">
                            "I like the way you work it <br>
                            No diggity <br>
                            I wanna bag it up"
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
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
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Team Members</h4>
                    </div>
                    <div class="content">
                        <ul class="list-unstyled team-members">
                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="avatar">
                                            <img src="<?=$bundle->baseUrl?>/images/faces/face-0.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        DJ Khaled
                                        <br />
                                        <span class="text-muted"><small>Offline</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="avatar">
                                            <img src="<?=$bundle->baseUrl?>/images/faces/face-1.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        Creative Tim
                                        <br />
                                        <span class="text-success"><small>Available</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="avatar">
                                            <img src="<?=$bundle->baseUrl?>/images/faces/face-3.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        Flume
                                        <br />
                                        <span class="text-danger"><small>Busy</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
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
                            <?= $form->field($userData, 'first_name')->textInput(['maxlength' => true, 'class'=>'form-control border-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userData, 'last_name')->textInput(['maxlength' => true, 'class'=>'form-control border-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userData, 'phone')->textInput(['maxlength' => true, 'class'=>'form-control border-input']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($userData, 'skype')->textInput(['maxlength' => true, 'class'=>'form-control border-input']) ?>
                        </div>
                            
                            <?= $form->field($userData, 'comment')->textarea(['rows' => 6, 'class'=>'form-control border-input']) ?>
                        
                        <?= Html::error($photoModel, 'imageFile', ['class' => 'help-block'])?>
                        <label class="btn btn-default btn-file">
                            Browse <input type="file" id="userdata-photo" name="UserData[photo]" style="display: none;">
                        </label>

                        <div class="form-group">
                            <?= Html::submitButton($user->isNewRecord ? 'Create' : 'Update', ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
