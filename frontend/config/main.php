<?php

use yii\web\Request;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$baseUrl = str_replace('/frontend/web', '', (new Request())->getBaseUrl());
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'providers' => [
            'class' => 'frontend\modules\providers\Providers',
            'defaultRoute' => 'site/index'
        ],
        'users' => [
            'class' => 'frontend\modules\users\Users',
            'defaultRoute' => 'site/index'
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend_' . env('APP_ID'),
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend_' . env('APP_ID'), 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend_' . env('APP_ID'),
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<modules>/categories/<id:\d+>' => '<modules>/categories',
                '<modules>/services/<id:\d+>' => '<modules>/services',
                '<modules>/services/provide/<id:\d+>' => '<modules>/services/provide',
                '<modules>/my/view/<id:\d+>' => '<modules>/my/view',
            ],
        ],

    ],
    'params' => $params,
];
