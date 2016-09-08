<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;
use common\assets\NotificationAsset;

use common\models\User;

$bundle = AppAsset::register($this);
NotificationAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerJs("NotificationManager.showMessages(".\yii\helpers\Json::encode(Yii::$app->session->getAllFlashes()).");", yii\web\View::POS_END, 'my-options');?>
</head>
<body>
<?php $this->beginBody() ?>

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header">
            <a class="navbar-brand" href="index.html"><img src="<?=$bundle->baseUrl.'/images/logo_light.png'?>" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
                        <?= Html::img($bundle->baseUrl.'/images/flags/' . Yii::$app->language . '.png', ['class'=>'position-left'])?>
						<?= common\widgets\LanguageWidget::getCurrentLanguage()?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
                        <?= common\widgets\LanguageWidget::widget()?>
					</ul>
				</li>

                <li>
                    <a href="<?= Url::toRoute('site/logout')?>" data-method="post">
                        <i class="icon-switch2"></i>
                        Logout
                    </a>
                </li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
                                <a href="<?= Yii::$app->urlManagerFrontend->createUrl('/user/profile')?>" class="media-left media-middle">
                                    <img src="<?=  common\helpers\UserHelper::getAvatarUrl(User::getCurrentUser()->userData->photo)?>" class="img-circle img-sm" alt="">
                                </a>
								<div class="media-left media-middle">
									<?= User::getCurrentUser()->username?>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                <?php
                                    echo yii\widgets\Menu::widget([
                                        'items' => [
                                            // Important: you need to specify url as 'controller/action',
                                            // not just as 'controller' even if default action is used.
                                            ['label' => Yii::t('backendMenu', 'Go to Frontend'), 'url' => ['/'], 'template' => '<a href="'.Yii::$app->urlManagerFrontend->createUrl('/').'"><i class="icon-arrow-left52"></i><p>{label}</p></a>'],
                                            ['label' => Yii::t('backendMenu', 'Home'), 'url' => ['/'], 'template' => '<a href="{url}"><i class="icon-home4"></i><p>{label}</p></a>'],
                                            ['label' => Yii::t('backendMenu', 'Users'), 'url' => ['/user/index'], 'template' => '<a href="{url}"><i class="icon-user"></i><p>{label}</p></a>'],
                                            ['label' => Yii::t('backendMenu', 'News'), 'url' => ['/news/index'], 'template' => '<a href="{url}"><i class="icon-newspaper"></i><p>{label}</p></a>'],
                                            ['label' => Yii::t('backendMenu', 'Poll'), 'url' => ['/poll/index'], 'template' => '<a href="{url}"><i class="icon-list2"></i><p>{label}</p></a>'],
                                            ['label' => Yii::t('backendMenu', 'Company events'), 'url' => ['/event/index'], 'template' => '<a href="{url}"><i class="icon-megaphone"></i><p>{label}</p></a>'],
                                            ['label' => Yii::t('backendMenu', 'Translations'), 'url' => ['/translations'], 'template' => '<a href="{url}"><i class="icon-sphere"></i><p>{label}</p></a>'],
                                        ],
                                        'options' => [
                                            'class' => 'nav',
                                        ],
                                        'activeCssClass' => 'active',
                                    ]);
                                ?>
<!--								<li>
									<a href="#"><i class="icon-stack2"></i> <span>Page layouts</span></a>
									<ul>
										<li><a href="<?=Url::toRoute('/site/test')?>">Fixed navbar</a></li>
										<li><a href="layout_navbar_sidebar_fixed.html">Fixed navbar &amp; sidebar</a></li>
										<li><a href="layout_sidebar_fixed_native.html">Fixed sidebar native scroll</a></li>
										<li><a href="layout_navbar_hideable.html">Hideable navbar</a></li>
										<li><a href="layout_navbar_hideable_sidebar.html">Hideable &amp; fixed sidebar</a></li>
										<li><a href="layout_footer_fixed.html">Fixed footer</a></li>
										<li class="navigation-divider"></li>
										<li><a href="boxed_default.html">Boxed with default sidebar</a></li>
										<li><a href="boxed_mini.html">Boxed with mini sidebar</a></li>
										<li><a href="boxed_full.html">Boxed full width</a></li>
									</ul>
								</li>-->
								<!-- /main -->
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">
                    <?= yii\widgets\Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);?>
                    <?=''// Alert::widget() ?>
                    <?= $content ?>

					<!-- Footer -->
					<div class="footer text-muted">
						&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
