<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Description of SharedAsset
 *
 * @author AlexR
 */
class SharedAsset extends AssetBundle{

    public $sourcePath = '@common';
    
    public $css = [
        //notification
        'themes/frontend-theme/css/animate.min.css',
        'themes/frontend-theme/css/notification.css',
        'themes/frontend-theme/css/themify-icons.css',
    ];
    public $js = [
        // notification
        'themes/frontend-theme/js/bootstrap-notify.js',
        // shared
        'js/shared.js'
    ];
//    public $publishOptions = ['forceCopy' => true];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
