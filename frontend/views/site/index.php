<?php
use \yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = Yii::t('page-title', 'News');
$bundle = \frontend\assets\AppAsset::register($this);
?>
<div class="row">
    <div class="col-md-6">
        <h3 class="title text-center"><?= Yii::t('app', 'Latest news');?></h3>
        <?= ListView::widget([
            'dataProvider' => $newsDataProvider,
            'itemView' => '../_shared/_newsItem',
            'layout' => "{items}",
            'emptyText' => ''
        ]); ?>
        <?php if(empty($newsDataProvider->getModels())):?>
            <h4 class="text-center">No articles</h4>
        <?php else: ?>
            <h6 class="text-right">
                <a href="<?= \yii\helpers\Url::to('/news')?>">
                    All news <i class="ti-angle-double-right"></i>
                </a>
            </h6>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <h3 class="title text-center"><?= Yii::t('app', 'Information');?></h3>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-circle-chart" data-background="color"  data-color="blue">
            <div class="header text-center">
                <h5 class="title"><i class="ti-gift"></i> <?= Yii::t('app', 'Upcoming birthdays');?></h5>
                <p class="description"></p>
            </div>
            <div class="content">
                <?php foreach ($birthdays as $birthday): ?>
                    <?= \yii\helpers\Html::a($birthday['name'], \yii\helpers\Url::to('/user/view/'.$birthday['id'])) ?>: <?= $birthday['birthday'] ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    fsdf
</div>