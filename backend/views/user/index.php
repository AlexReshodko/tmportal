<?php

use yii\helpers\Html;
use common\components\BackendGridView;
use common\helpers\UtilsHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
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
            UtilsHelper::getStatusGridLabel($dataProvider),
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