<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Menu;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;
use common\widgets\LanguageWidget;

$bundle = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= $bundle->baseUrl . '/images/apple-icon.png' ?>">
        <link rel="icon" type="image/x-icon" sizes="96x96" href="<?= $bundle->baseUrl . '/images/favicon.ico?' . microtime() ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <?php $this->registerJs("NotificationManager.showMessages(".\yii\helpers\Json::encode(Yii::$app->session->getAllFlashes()).");", yii\web\View::POS_END, 'my-options');?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="danger">
            <!--
                Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
                Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
            -->
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="/" class="simple-text">
                            <?= Yii::$app->name ?>
                        </a>
                    </div>
                    <div class="logo logo-mini">
                        <a href="/"  class="simple-text">
                            TMP
                        </a>
                    </div>
                    <?= common\widgets\UserWidget::widget() ?>
                    <?php
                    echo Menu::widget([
                        'items' => [
                            // Important: you need to specify url as 'controller/action',
                            // not just as 'controller' even if default action is used.
                            ['label' => Yii::t('app', 'Home'), 'url' => ['site/index'], 'template' => '<a href="{url}"><i class="ti-home"></i><p>{label}</p></a>'],
                            ['label' => Yii::t('app', 'News'), 'url' => ['news/index'], 'template' => '<a href="{url}"><i class="ti-book"></i><p>{label}</p></a>'],
                            ['label' => Yii::t('app', 'My profile'), 'url' => ['user/profile'], 'template' => '<a href="{url}"><i class="ti-user"></i><p>{label}</p></a>'],
                            ['label' => Yii::t('app', 'Office map'), 'url' => ['site/office-map'], 'template' => '<a href="{url}"><i class="ti-map-alt"></i><p>{label}</p></a>'],
                            ['label' => Yii::t('app', 'Gallery'), 'active'=>\Yii::$app->controller->id == 'gallery', 'url' => ['gallery/index'], 'template' => '<a href="{url}"><i class="ti-gallery"></i><p>{label}</p></a>'],
                        ],
                        'options' => [
                            'class' => 'nav',
                        ],
                        'activeCssClass' => 'active',
                    ]);
                    ?>
                </div>
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
<!--                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                        </div>-->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#"><?= $this->title; ?></a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
                                        <i class="ti-world"></i>
                                        <p>
                                            <?= Yii::t('app', 'Language') ?>
                                            <b class="caret"></b>
                                        </p>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?= LanguageWidget::widget()?>
                                    </ul>
                                </li>
                                <?php if (Yii::$app->user->identity->role == \common\models\User::ROLE_ADMIN): ?>
                                    <li>
                                        <a href="<?= Url::toRoute('/backend') ?>">
                                            <i class="ti-settings"></i>
                                            <p><?= Yii::t('app', 'Administration')?></p>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="btn-magnify">
                                <?php if (Yii::$app->user->isGuest): ?>
                                        <a href="<?= Url::toRoute('site/login') ?>" data-method="post">
                                            <i class="ti-power-off"></i>
                                            <p>Login</p>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= Url::toRoute('site/logout') ?>" data-method="post">
                                            <i class="ti-power-off"></i>
                                            <p>Logout</p>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>

                <div class="content">
                    <div class="container-fluid">
                        <?= ''//Alert::widget() ?>
                        <?= $content ?>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <?= Yii::powered() ?>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright pull-right">
                            <a href="http://testmatick.com">&copy; TestMatick Ltd. <?= date('Y') ?></a>
                        </div>
                    </div>
                </footer>
                <script type="text/javascript">
                    $(document).ready(function () {
                    });
                </script>
            </div>
        </div>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
