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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            [
                'label' => 'Role',
                'value' => $model->getRoleName()
            ],
            'status',
            [
                'label' => 'First name',
                'value' => $model->userData->first_name
            ],
            [
                'label' => 'Last name',
                'value' => $model->userData->last_name
            ],
            [
                'label' => 'Address',
                'value' => $model->userData->address
            ],
            [
                'label' => 'Phone',
                'value' => $model->userData->phone
            ],
            [
                'label' => 'Skype',
                'value' => $model->userData->skype
            ],
            [
                'label' => 'Office',
                'value' => $model->userData->office ? $model->userData->office->name : ''
            ],
            [
                'label' => 'Position',
                'value' => $model->userData->position ? $model->userData->position->name : ''
            ],
            [
                'label' => 'Gender',
                'value' => $model->userData->getGenderName()
            ],
            [
                'label' => 'Hire date',
                'format' => 'raw',
                'value' => common\helpers\UtilsHelper::getFormattedDate($model->userData->hire_date)
            ],
            [
                'label' => 'Birthday',
                'format' => 'raw',
                'value' => common\helpers\UtilsHelper::getFormattedDate($model->userData->birthday)
            ]
//            'hire_date:date', 
//            'birthday:date',
////            'comment',
//            'photo',
        ],
    ]) ?>

</div>
