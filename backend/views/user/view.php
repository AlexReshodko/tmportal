<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= ''/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'role',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) */?>
    <?= DetailView::widget([
        'model' => $model->userData,
        'attributes' => [
            'first_name',
            'last_name',
            [
                'label' => 'Office',
                'value' => $model->userData->office->name
            ],
            [
                'label' => 'Position',
                'value' => $model->userData->position ? $model->userData->position->name : ''
            ],
            [
                'label' => 'Gender',
                'value' => common\models\UserData::getGender($model->userData->gender)
            ],
            'address',
            'phone',
            'skype',
            'hire_date:date', 
            'birthday:date',
//            'comment',
            'photo',
            'map_place', 
        ],
    ]) ?>

</div>
