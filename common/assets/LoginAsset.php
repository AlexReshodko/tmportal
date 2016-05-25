<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LoginAsset extends AssetBundle {

    public $sourcePath = '@common/themes/backend-theme';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900',
        'css/icons/icomoon/styles.css',
        'css/minified/bootstrap.min.css',
        'css/minified/core.min.css',
        'css/minified/components.min.css',
        'css/minified/colors.min.css'
    ];
    public $js = [
        'js/plugins/loaders/pace.min.js',
        'js/core/libraries/jquery.min.js',
        'js/core/libraries/bootstrap.min.js',
        'js/plugins/loaders/blockui.min.js',
        'js/core/app.js',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
//    public $publishOptions = ['forceCopy' => true];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
