<?php

use yii\helpers\Html;
use common\components\BackendGridView;
use yii\widgets\Pjax;
use common\helpers\UtilsHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('page-title', 'Company Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend-button', 'Create Company Event'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= BackendGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'description:ntext',
            'date:date',
            [
                'label' => 'Thumbnail',
                'format' => 'raw',
                'value' => function($data) {
                    $filePath = common\helpers\UtilsHelper::getImageUrl($data->thumbnail);
                    return Html::img($filePath, [
                        'alt' => 'Thumbnail',
                    ]);
                },
            ],
            UtilsHelper::getStatusGridLabel($dataProvider),
            [
                'label' => '№ of Photos',
                'format' => 'raw',
                'value' => function($data){
                    return count($data->photos);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{addPhotos} {view} {update} {delete}',
                'buttons' => [
                    'addPhotos' => function ($url,$model,$key) {
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', 'add-photos/'.$key, ['title'=> 'Add photos']);
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
