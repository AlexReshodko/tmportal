<?php

use yii\helpers\Html;
use common\widgets\CreateUpdateWidget;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $user->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <?= CreateUpdateWidget::widget([
        'params' => [
            'title' => Html::encode($this->title),
            'view' => 'user',
            'viewParams' => [
                'user' => $user,
                'userData' => $user->userData,
            ]
        ]
    ])?>

</div>
