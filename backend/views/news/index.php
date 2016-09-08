<?php

use yii\helpers\Html;
use common\components\BackendGridView;
use common\helpers\UtilsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create article'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= BackendGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'author_id',
            'title',
            'text:raw',
            'date',
            'views',
            UtilsHelper::getStatusGridLabel($dataProvider),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
