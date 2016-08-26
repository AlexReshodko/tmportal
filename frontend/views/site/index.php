<?php
/* @var $this yii\web\View */

$this->title = Yii::t('page-title', 'Dashboard');
$bundle = \frontend\assets\AppAsset::register($this);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h3 class="title text-center"><?= Yii::t('app', 'Latest news');?></h3>
            <ul class="news">
                <li>
                    <div class="news-panel">
                        <div class="news-heading text-center">
                            <h4 class="header"><a href="#">Mussum ipsum cacilds</a></h4>
                            <!--<span class="label label-danger">Mussum ipsum cacilds</span>-->
                        </div>
                        <div class="news-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo.
                                Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        </div>
                        <h6 class="text-right">
                            <a href="#">
                                Read more...
                            </a>
                        </h6>
                    </div>
                </li>
                <li>
                    <div class="news-panel">
                        <div class="timeline-heading">
                            <span class="label label-success">Mussum ipsum cacilds</span>
                        </div>
                        <div class="timeline-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo.
                                Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="news-panel">
                        <div class="timeline-heading">
                            <span class="label label-info">Mussum ipsum cacilds</span>
                        </div>
                        <div class="timeline-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo.
                                Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        </div>
                    </div>
                </li>
            </ul>
            <h6 class="text-right">
                <a href="#">
                    All news <i class="ti-angle-double-right"></i>
                </a>
            </h6>
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
</div>