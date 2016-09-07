<?php
use \yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = Yii::t('page-title', 'Dashboard');
$bundle = \frontend\assets\AppAsset::register($this);
?>
<div class="row">
        <div class="col-md-6">
            <h3 class="title text-center"><?= Yii::t('news', 'Latest news');?></h3>
        </div>
        <div class="col-md-6">
            <h3 class="title text-center"><?= Yii::t('app', 'Information');?></h3>
        </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= ListView::widget([
            'dataProvider' => $newsDataProvider,
            'itemView' => '../_shared/_newsItem',
            'layout' => "{items}",
            'emptyText' => ''
        ]); ?>
        <?php if(empty($newsDataProvider->getModels())):?>
            <div class="card">
                <div class="header text-center">
                    <h4 class="text-center"><?= Yii::t('news', 'No articles')?></h4>
                </div>
                <div class="content text-center"></div>
            </div>
        <?php else: ?>
            <h6 class="text-right">
                <a href="<?= \yii\helpers\Url::to('/news')?>">
                    <?= Yii::t('news', 'All news')?> <i class="ti-angle-double-right"></i>
                </a>
            </h6>
        <?php endif; ?>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="header text-center">
                <h5 class="title"><i class="ti-gift"></i> <?= Yii::t('app', 'Upcoming birthdays');?></h5>
                <hr />
            </div>
            <div class="content text-center">
                <?php foreach ($birthdays as $birthday): ?>
                    <h5><?= \yii\helpers\Html::a($birthday['name'], \yii\helpers\Url::to('/user/view/'.$birthday['id'])) ?>: <?= $birthday['birthday'] ?></h5>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="header text-center">
                <h5 class="title"><i class="ti-list"></i> <?= Yii::t('app', 'Poll');?></h5>
                <hr />
            </div>
            <div class="content">
                <?= \common\widgets\PollWidget::widget()?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="content">
                fsdf
            </div>
        </div>
    </div>
</div>