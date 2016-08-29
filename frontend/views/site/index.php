<?php
/* @var $this yii\web\View */

$this->title = Yii::t('page-title', 'News');
$bundle = \frontend\assets\AppAsset::register($this);
?>
<div class="row">
    <div class="col-md-6">
        <h3 class="title text-center"><?= Yii::t('app', 'Latest news');?></h3>
        <?= common\widgets\NewsWidget::widget(['news'=>$news])?>
        <?php if(empty($news)):?>
            No articles
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
<!--        <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-2">
                        <div class="icon-big icon-warning text-center">
                            <i class="ti-gift"></i>
                        </div>
                    </div>
                    <div class="col-xs-10">
                        <div class="text-center" style="font-size: 1.5em;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr />
                <div class="stats">
                    <i class="ti-reload"></i> Updated now
                </div>
            </div>
        </div>
    </div>-->
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
    <div class="col-lg-3 col-sm-6">
        <div class="card card-circle-chart" data-background="color"  data-color="blue">
            <div class="header text-center">
                <h5 class="title">Dashboard</h5>
                <p class="description">Monthly sales target</p>
            </div>
            <div class="content">
                <div id="chartDashboard" class="chart-circle" data-percent="70">70%</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="icon-big icon-success text-center">
                            <i class="ti-wallet"></i>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="numbers">
                            <p>Revenue</p>
                            $1,345
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr />
                <div class="stats">
                    <i class="ti-calendar"></i> Last day
                </div>
            </div>
        </div>
    </div>
</div>