<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use nirvana\infinitescroll\InfiniteScrollPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <!--<h1 class="text-center"><?= Html::encode($this->title) ?></h1>-->

    <?=''// common\widgets\NewsWidget::widget(['news'=>$news])?>
    <?= ListView::widget([
        'id' => 'my-listview-id',
        'dataProvider' => $dataProvider,
        'itemView' => '../_shared/_newsItem',
        'options' => [
            'class' => 'col-md-8 col-md-offset-2'
        ],
        'layout' => "<div class=\"items\">{items}</div>\n<div class=\"text-center\">{pager}</div>",
        'pager' => [
            'class' => InfiniteScrollPager::className(),
            'widgetId' => 'my-listview-id',
            'itemsCssClass' => 'items',
            'contentLoadedCallback' => 'MainApp.afterAjaxListViewUpdate',
            'nextPageLabel' => 'Load more news',
            'linkOptions' => [
                'class' => 'btn btn-lg btn-block',
            ],
            'pluginOptions' => [
                'loading' => [
                    'msgText' => "<h3>Loading next articles...</h3>",
                    'finishedMsg' => "<h3>No more articles</h3>",
                ],
                'behavior' => InfiniteScrollPager::BEHAVIOR_TWITTER,
            ],
        ],
//        'layout' => '{items}<div class="text-center">{pager}</div>'
//            'itemOptions' => [
//                'class' => 'col-md-6'
//            ]
    ]); ?>
</div>
