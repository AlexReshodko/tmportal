<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $sourcePath = '@common/themes/frontend-theme';
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/animate.min.css',
        'css/paper-dashboard.css',
        'css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Muli:400,300',
        'css/themify-icons.css',
        'css/main.css',
    ];
    public $js = [
        // Core
//        'js/jquery-1.10.2.js',
        'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
        
        //Forms Validations Plugin
        'js/jquery.validate.min.js',
        
        // Plugin for Date Time Picker and Full Calendar Plugin
        'js/moment.min.js',
        
        // Select Picker Plugin
        'js/bootstrap-datetimepicker.js',
        
        // Checkbox, Radio, Switch and Tags Input Plugins
        'js/bootstrap-checkbox-radio-switch-tags.js',
        
        // Circle Percentage-chart
//        'js/jquery.easypiechart.min.js',
        
        // Charts Plugin
//        'js/chartist.min.js',
        
        // Notifications Plugin
//        'js/bootstrap-notify.js',
        
        // Sweet Alert 2 plugin
        'js/sweetalert2.js',
        
        // Vector Map plugin
//        'js/jquery-jvectormap.js',
        
        // Google Maps Plugin
//        'https://maps.googleapis.com/maps/api/js?key=AIzaSyBFEbpuIHsQQeWN0UhmO568TQaVH-oaDps',
        
        // Wizard Plugin
//        'js/jquery.bootstrap.wizard.min.js',
        
        // Datatable Plugin
//        'js/bootstrap-table.js',
        
        // Full Calendar Plugin
//        'js/fullcalendar.min.js',
        
        // SNAP SVG for office map
        'js/snap.svg-min.js',
        
        // Paper Dashboard Core javascript and methods for Demo purpose
        'js/paper-dashboard.js',
//        'js/demo.js',
        
        // Application scripts
        'js/main.js',
        
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $publishOptions = ['forceCopy' => true];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
