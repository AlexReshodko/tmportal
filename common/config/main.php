<?php

return [
    'language' => 'en',
    'sourceLanguage' => 'en-US',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            // here is your normal backend url manager config
            'class' => codemix\localeurls\UrlManager::className(),
            'ignoreLanguageUrlPatterns' => [
                '#^backend#' => '#^backend#',
            ],
            'languages' => ['en', 'ru-RU', 'uk'],
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'scriptUrl'=>'/backend/index.php',
        ],
        'urlManagerFrontend' => [
            // here is your frontend URL manager config
            'class' => codemix\localeurls\UrlManager::className(),
            'languages' => ['en', 'ru-RU', 'uk'],
            'baseUrl' => '/',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'scriptUrl'=>'/index.php',
        ],
        'i18n' => [
            'class' => Zelenin\yii\modules\I18n\components\I18N::className(),
            'languages' => ['en-US', 'ru-RU', 'uk']
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'itemFile' => '@console/rbac/items.php',
            'assignmentFile' => '@console/rbac/assignments.php',
        ],
    ],
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
    ],
];
