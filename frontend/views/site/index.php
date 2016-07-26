<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard';
$bundle = \frontend\assets\AppAsset::register($this);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
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
                                <?php foreach ($birthdays as $birthday): ?>
                                    <?= $birthday['name'] ?>: <?= $birthday['birthday'] ?>
                                <?php endforeach; ?>
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
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-pulse"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Errors</p>
                                23
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats">
                        <i class="ti-timer"></i> In the last hour
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-twitter-alt"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Followers</p>
                                +45
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
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="numbers pull-left">
                                $34,657
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="pull-right" style="padding-top:7px;">
                                <span class="label label-success">
                                    +18%
                                </span>
                            </div>
                        </div>
                    </div>
                    <h6 class="big-title">total earnings <span class="text-muted">in last</span> ten <span class="text-muted">quarters</span></h6>
                    <div id="chartTotalEarnings"></div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="footer-title">Financial Statistics</div>
                    <div class="pull-right">
                        <button class="btn btn-info btn-fill btn-icon btn-sm">
                            <i class="ti-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="numbers pull-left">
                                169
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="pull-right" style="padding-top:7px;">
                                <span class="label label-danger">
                                    -14%
                                </span>
                            </div>
                        </div>
                    </div>
                    <h6 class="big-title">total subscriptions <span class="text-muted">in last</span> 7 days</h6>
                    <div id="chartTotalSubscriptions"></div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="footer-title">View all members</div>
                    <div class="pull-right">
                        <button class="btn btn-default btn-fill btn-icon btn-sm">
                            <i class="ti-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="numbers pull-left">
                                8,960
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="pull-right" style="padding-top:7px;">
                                <span class="label label-warning">
                                    ~51%
                                </span>
                            </div>
                        </div>
                    </div>
                    <h6 class="big-title">total downloads <span class="text-muted">in last</span> 6 years</h6>
                    <div id="chartTotalDownloads" ></div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="footer-title">View more details</div>
                    <div class="pull-right">
                        <button class="btn btn-success btn-fill btn-icon btn-sm">
                            <i class="ti-info"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
            <div class="card card-circle-chart" data-background="color"  data-color="green">
                <div class="header text-center">
                    <h5 class="title">Orders</h5>
                    <p class="description">Completed</p>
                </div>
                <div class="content">
                    <div id="chartOrders" class="chart-circle" data-percent="34">34%</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-circle-chart" data-background="color"  data-color="orange">
                <div class="header text-center">
                    <h5 class="title">New Visitors</h5>
                    <p class="description">Out of total number</p>
                </div>
                <div class="content">
                    <div id="chartNewVisitors" class="chart-circle" data-percent="62">62%</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-circle-chart" data-background="color"  data-color="brown">
                <div class="header text-center">
                    <h5 class="title">Subscriptions</h5>
                    <p class="description">Monthly newsletter</p>
                </div>
                <div class="content">
                    <div id="chartSubscriptions" class="chart-circle" data-percent="10">10%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Email Statistics</h4>
                    <p class="category">Last Campaign Performance</p>
                </div>
                <div class="content">
                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                </div>
                <div class="card-footer">
                    <div class="chart-legend">
                        <i class="fa fa-circle text-info"></i> Open
                        <i class="fa fa-circle text-danger"></i> Bounce
                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="ti-timer"></i> Campaign sent 2 days ago
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card ">
                <div class="header">
                    <h4 class="title">2015 Sales</h4>
                    <p class="category">All products including Taxes</p>
                </div>
                <div class="content">
                    <div id="chartActivity" class="ct-chart"></div>
                </div>
                <div class="card-footer">
                    <div class="chart-legend">
                        <i class="fa fa-circle text-info"></i> Tesla Model S
                        <i class="fa fa-circle text-warning"></i> BMW 5 Series
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="ti-check"></i> Data information certified
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Users Behavior</h4>
                    <p class="category">24 Hours performance</p>
                </div>
                <div class="content">
                    <div id="chartHours" class="ct-chart"></div>
                </div>
                <div class="card-footer">
                    <div class="chart-legend">
                        <i class="fa fa-circle text-info"></i> Open
                        <i class="fa fa-circle text-danger"></i> Click
                        <i class="fa fa-circle text-warning"></i> Click Second Time
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="ti-reload"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Global Sales by Top Locations</h4>
                    <p class="category">All products that were shipped</p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="<?= $bundle->baseUrl ?>/images/flags/US.png" 
                                                </div>
                                            </td>
                                            <td>USA</td>
                                            <td class="text-right">
                                                2.920
                                            </td>
                                            <td class="text-right">
                                                53.23%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="<?= $bundle->baseUrl ?>/images/flags/DE.png" 
                                                </div>
                                            </td>
                                            <td>Germany</td>
                                            <td class="text-right">
                                                1.300
                                            </td>
                                            <td class="text-right">
                                                20.43%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="<?= $bundle->baseUrl ?>/images/flags/AU.png" 
                                                </div>
                                            </td>
                                            <td>Australia</td>
                                            <td class="text-right">
                                                760
                                            </td>
                                            <td class="text-right">
                                                10.35%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="<?= $bundle->baseUrl ?>/images/flags/GB.png" 
                                                </div>
                                            </td>
                                            <td>United Kingdom</td>
                                            <td class="text-right">
                                                690
                                            </td>
                                            <td class="text-right">
                                                7.87%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="<?= $bundle->baseUrl ?>/images/flags/RO.png" 
                                                </div>
                                            </td>
                                            <td>Romania</td>
                                            <td class="text-right">
                                                600
                                            </td>
                                            <td class="text-right">
                                                5.94%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flag">
                                                    <img src="<?= $bundle->baseUrl ?>/images/flags/BR.png" 
                                                </div>
                                            </td>
                                            <td>Brasil</td>
                                            <td class="text-right">
                                                550
                                            </td>
                                            <td class="text-right">
                                                4.34%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-1">
                            <div id="worldMap" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Tasks</h4>
                    <p class="category">Backend development</p>
                </div>
                <div class="content">
                    <div class="table-full-width table-tasks">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Sign contract for "What are conference organizers afraid of?"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                        </label>
                                    </td>
                                    <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                        </label>
                                    </td>
                                    <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Read "Following makes Medium better"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Unfollow 5 enemies from twitter</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
            <div class="card card-chat">
                <div class="header">
                    <h4 class="title">Chat</h4>
                    <p class="category">With Tania Andrew</p>
                </div>
                <div class="content">
                    <ol class="chat">
                        <li class="other">
                            <div class="avatar">
                                <img src="<?= $bundle->baseUrl ?>/images/faces/face-2.jpg"  alt="crash"/>
                            </div>
                            <div class="msg">
                                <p>
                                    Hola!
                                    How are you?
                                </p>
                                <div class="card-footer">
                                    <i class="ti-check"></i>
                                    <h6>11:20</h6>
                                </div>
                            </div>
                        </li>
                        <li class="self">
                            <div class="avatar">
                                <img src="<?= $bundle->baseUrl ?>/images/default-avatar.png"  alt="crash"/>
                            </div>
                            <div class="msg">
                                <p>
                                    Puff...
                                    I'm alright. How are you?
                                </p>
                                <div class="card-footer">
                                    <i class="ti-check"></i>
                                    <h6>11:22</h6>
                                </div>
                            </div>
                        </li>
                        <li class="other">
                            <div class="avatar">
                                <img src="<?= $bundle->baseUrl ?>/images/faces/face-2.jpg"  alt="crash"/>
                            </div>
                            <div class="msg">
                                <p>
                                    I'm ok too!
                                </p>
                                <div class="card-footer">
                                    <i class="ti-check"></i>
                                    <h6>11:24</h6>
                                </div>
                            </div>
                        </li>
                        <li class="self">
                            <div class="no-avatar"></div>
                            <div class="msg">
                                <p>
                                    Well, it was nice hearing from you.
                                </p>
                                <div class="card-footer">
                                    <i class="ti-check"></i>
                                    <h6>11:25</h6>
                                </div>
                            </div>
                        </li>
                        <li class="self">
                            <div class="avatar">
                                <img src="<?= $bundle->baseUrl ?>/images/default-avatar.png"  alt="crash"/>
                            </div>
                            <div class="msg">
                                <p>
                                    OK, bye-bye
                                    See you!
                                </p>
                                <div class="card-footer">
                                    <i class="ti-check"></i>
                                    <h6>11:25</h6>
                                </div>
                            </div>
                        </li>
                    </ol>
                    <hr>
                    <div class="send-message">
                        <div class="avatar">
                            <img src="<?= $bundle->baseUrl ?>/images/default-avatar.png"  alt="crash"/>
                        </div>
                        <input class="form-control textarea" type="text" placeholder="Type here!"/>
                        <div class="send-button">
                            <button class="btn btn-primary btn-fill">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <ul class="timeline timeline-simple">
                <li class="timeline-inverted">
                    <div class="timeline-badge danger">
                        <i class="ti-gallery"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <span class="label label-danger">Mussum ipsum cacilds</span>
                        </div>
                        <div class="timeline-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo.
                                Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        </div>
                        <h6>
                            <i class="ti-time"></i>
                            11 hours ago via Twitter
                        </h6>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-badge success">
                        <i class="ti-check-box"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <span class="label label-success">Mussum ipsum cacilds</span>
                        </div>
                        <div class="timeline-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo.
                                Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                        </div>
                    </div>
                </li>
                <li class="timeline-inverted">
                    <div class="timeline-badge info">
                        <i class="ti-credit-card"></i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <span class="label label-info">Mussum ipsum cacilds</span>
                        </div>
                        <div class="timeline-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo.
                                Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
                            <hr>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-settings"></i> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#action">Action</a></li>
                                    <li><a href="#action">Another action</a></li>
                                    <li><a href="#here">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#link">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        demo.initChartsDashboard1();
        demo.initVectorMap();
        demo.initCirclePercentage();

    });
</script>