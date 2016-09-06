<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'model' => [
                    'class' => 'common\generators\model\Generator',
                    'templates' => [
                        'base' => '@common/generators/model/default',
                    ]
                ]
            ],
        ],
    ],
    'params' => $params,
];
