<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\UserHelper;
use common\helpers\UtilsHelper;

/* @var $this yii\web\View */
/* @var $userData common\models\UserData */

$this->title = Yii::t('pageTitle', 'User profile: '.$userData->getFullName());
$this->params['breadcrumbs'][] = ['label' => 'User Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-data-view">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $userData->getFullName()?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?= UserHelper::getAvatarUrl($userData->photo)?>" class="img-rounded img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 "> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Department:</td>
                                        <td><?= isset($userData->position) ? $userData->position->name : 'Not set' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hire date:</td>
                                        <td><?= UtilsHelper::getFormattedDate($userData->hire_date)?></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td><?= UtilsHelper::getFormattedDate($userData->birthday)?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?= common\models\UserData::getGender($userData->gender)?></td>
                                    </tr>
                                    <tr>
                                        <td>Home Address</td>
                                        <td><?= $userData->address ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><a href="mailto:<?= $userData->user->email ?>"><?= $userData->user->email ?></a></td>
                                    </tr>
                                    <tr>
                                        <td>Skype</td>
                                        <td><a href="skype:<?= $userData->skype ?>?chat"><?= $userData->skype ?></a></td>
                                    </tr>
                                    <tr><td>Phone Number</td>
                                        <td><?= $userData->phone ?></td>
                                    </tr>
                                </tbody>
                            </table>
<!--                            <a href="#" class="btn btn-primary">My Sales Performance</a>
                            <a href="#" class="btn btn-primary">Team Sales Performance</a>-->
                        </div>
                    </div>
                </div>
<!--                <div class="panel-footer">
                    <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                    <span class="pull-right">
                        <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                        <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                    </span>
                </div>-->

            </div>
        </div>
    </div>
</div>
