<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\widgets\Alert;
use common\assets\LoginAsset;
use common\assets\NotificationAsset;

LoginAsset::register($this);
NotificationAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerJs("NotificationManager.showMessages(".\yii\helpers\Json::encode(Yii::$app->session->getAllFlashes()).");", yii\web\View::POS_END, 'my-options');?>
</head>
<body>
<?php $this->beginBody() ?>
    <!-- Page container -->
    <div class="page-container login-container">
        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">
                    <div class="panel panel-body login-form">
                        <?= $content ?>
                    </div>
                    <div class="footer text-muted">
                        &copy; <?= date('Y') ?>. <a href="http://testmatick.com">TestMatick</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function containerHeight() {
            var availableHeight = $(window).height() - $('body > .navbar').outerHeight() - $('body > .navbar + .navbar').outerHeight() - $('body > .navbar + .navbar-collapse').outerHeight();

            $('.page-container').attr('style', 'min-height:' + availableHeight + 'px');
        }
        // Mobile sidebar setup
        // -------------------------

        $(window).on('resize', function() {
            setTimeout(function() {
                containerHeight();

                if($(window).width() <= 768) {

                    // Add mini sidebar indicator
                    $('body').addClass('sidebar-xs-indicator');

                    // Place right sidebar before content
                    $('.sidebar-opposite').insertBefore('.content-wrapper');

                    // Place detached sidebar before content
                    $('.sidebar-detached').insertBefore('.content-wrapper');
                }
                else {

                    // Remove mini sidebar indicator
                    $('body').removeClass('sidebar-xs-indicator');

                    // Revert back right sidebar
                    $('.sidebar-opposite').insertAfter('.content-wrapper');

                    // Remove all mobile sidebar classes
                    $('body').removeClass('sidebar-mobile-main sidebar-mobile-secondary sidebar-mobile-detached sidebar-mobile-opposite');

                    // Revert left detached position
                    if($('body').hasClass('has-detached-left')) {
                        $('.sidebar-detached').insertBefore('.container-detached');
                    }

                    // Revert right detached position
                    else if($('body').hasClass('has-detached-right')) {
                        $('.sidebar-detached').insertAfter('.container-detached');
                    }
                }
            }, 100);
        }).resize();
    </script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>