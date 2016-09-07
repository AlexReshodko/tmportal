<?php

use yii\helpers\Html;
use common\widgets\CreateUpdateWidget;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= CreateUpdateWidget::widget([
        'params' => [
            'title' => Html::encode($this->title),
            'view' => 'user',
            'viewParams' => [
                'user' => $user,
                'userData' => $userData,
            ]
        ]
    ])?>

</div>
