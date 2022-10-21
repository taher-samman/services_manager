<?php

use common\models\User;
use yii\web\Request;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$baseUrl = str_replace('/backend/web', '', (new Request())->getBaseUrl());
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'on beforeRequest' => function () {
        $count = User::find()->where(['status' => User::STATUS_INACTIVE])->count();
        if ($count > 0) {
            Yii::$app->session->setFlash('warning', "You Have $count Providers Waiting Your Account Activation");
        }
    },
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend_' . env('APP_ID'),
            'baseUrl' => $baseUrl . '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend_' . env('APP_ID'), 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend_' . env('APP_ID'),
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
                '' => 'site/index',
                'categories' => 'categories/index',
                'services' => 'services/index',
                'users' => 'users/index',
                '<categories>/<edit>/<id>' => '<categories>/<edit>',
                '<attributes>/<add>/<id>' => '<attributes>/<add>',
                '<services>/<edit>/<id>' => '<services>/<edit>',
                '<users>/<update>/<id>' => '<users>/<update>',
                '<services>/<delete-image>/<id>' => '<services>/<delete-image>',
            ],
        ],
    ],
    'params' => $params,
];
