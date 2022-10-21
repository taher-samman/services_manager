<?php

use yii\web\Request;

$baseUrl = str_replace('/frontend/web', '', (new Request())->getBaseUrl());
return [
    'components' => [
        'request' => [
            'class' => 'yii\web\Request',
            'baseUrl' => $baseUrl . '/providers',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'actions' => ['login', 'signup', 'error'],
                'allow' => true,
            ],
            [
                'actions' => ['logout', 'index', 'services', 'provide', 'view'],
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['site/login']);
        },
    ],
];
