<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class PaperAsset extends AssetBundle
{
    public $sourcePath = '@common/themes/frontend-theme';
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/animate.min.css',
        'css/paper-dashboard.css',
        'http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Muli:400,300',
        'css/themify-icons.css',
    ];
    public $js = [
        // Core
        'js/bootstrap.min.js',
        // Checkbox, Radio & Switch Plugins
        'js/bootstrap-checkbox-radio.js',
        // Charts Plugin
        'js/chartist.min.js',
        // Notifications Plugin
        'js/bootstrap-notify.js',
        // Paper Dashboard Core javascript and methods for Demo purpose
        'js/paper-dashboard.js',
        
        'js/demo.js'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
