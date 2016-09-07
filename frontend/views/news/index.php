<?php

use yii\widgets\ListView;
use nirvana\infinitescroll\InfiniteScrollPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('page-title', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <?=''// common\widgets\NewsWidget::widget(['news'=>$news])?>
    <?= ListView::widget([
        'id' => 'my-listview-id',
        'dataProvider' => $dataProvider,
        'itemView' => '../_shared/_newsItem',
        'emptyText' => '<h2>' . Yii::t('news', 'No articles found') . '</h2>',
        'emptyTextOptions' => ['class' => 'empty text-center'],
        'options' => [
            'class' => 'col-md-8 col-md-offset-2'
        ],
        'layout' => "<div class=\"items\">{items}</div>\n<div class=\"text-center\">{pager}</div>",
        'pager' => [
            'class' => InfiniteScrollPager::className(),
            'widgetId' => 'my-listview-id',
            'itemsCssClass' => 'items',
            'contentLoadedCallback' => 'MainApp.afterAjaxListViewUpdate',
            'nextPageLabel' => Yii::t('news', 'Load more news'),
            'linkOptions' => [
                'class' => 'btn btn-lg btn-block',
            ],
            'pluginOptions' => [
                'loading' => [
                    'msgText' => "<h3>" . Yii::t('news', 'Loading next articles') . "...</h3>",
                    'finishedMsg' => "<h3>" . Yii::t('news', 'No more articles') . "</h3>",
                ],
                'behavior' => InfiniteScrollPager::BEHAVIOR_TWITTER,
            ],
        ],
    ]); ?>
</div>
