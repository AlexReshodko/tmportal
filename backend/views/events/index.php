<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanyEventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Company Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-events-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company Event'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'date:date',
//            'thumbnail:image',
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
            [
                'label' => 'Published',
                'format' => 'raw',
                'value' => function($data){
                    $isPub = $data->published;
                    return '<span class="text-highlight '.($isPub ? 'bg-success':'bg-warning').'">'.($isPub ? 'Published':'Not published').'<span>';
                }
            ],
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
