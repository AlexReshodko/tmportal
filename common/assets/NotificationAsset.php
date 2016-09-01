<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Description of NotificationAsset
 *
 * @author AlexR
 */
class NotificationAsset extends AssetBundle {
    
    public $sourcePath = '@common/themes/frontend-theme';
    public $css = [
        'css/animate.min.css',
        'css/notification.css',
        'css/themify-icons.css',
    ];
    public $js = [
        'js/bootstrap-notify.js',
    ];
//    public $publishOptions = ['forceCopy' => true];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
