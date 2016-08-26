<?php

use yii\helpers\Html;
use common\components\BackendGridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-flat">

    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="panel-body">
        <p>
            <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <?= BackendGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'username',
            [
                'label' => 'Real name',
                'value' => function($data){
                    return $data->userData->getFullName();
                }
            ],
            [
                'label' => 'Status',
                'format' => 'raw',
                'value' => function($data){
                    $isActive = $data->status == common\models\User::STATUS_ACTIVE;
                    return '<span class="label label-'.($isActive ? 'success' : 'danger').'">'.($isActive ? 'Active' : 'Deleted').'</span>';
                }
            ],
            [
                'label' => 'Hire date',
                'format' => 'raw',
                'value' => function($data){
                    return common\helpers\UtilsHelper::getFormattedDate($data->userData->hire_date);
                }
            ],
            [
                'label' => 'Photo',
                'format' => 'raw',
                'value' => function($data) {
                    $filePath = common\helpers\UtilsHelper::getImageUrl($data->userData->photo);
                    return Html::img($filePath, [
                        'alt' => 'Photo',
                    ]);
                },
            ],
             'email:email',
            // 'role',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>