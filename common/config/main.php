<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            // here is your normal backend url manager config
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'scriptUrl'=>'/backend/index.php',
        ],
        'urlManagerFrontend' => [
            // here is your frontend URL manager config
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '/',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'scriptUrl'=>'/index.php',
        ],
    ],
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
    ],
];
