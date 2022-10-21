<?php

namespace backend\controllers;

use common\models\AttributeOptions;
use common\models\Attributes;
use common\models\Categories;
use common\models\Services;
use common\models\ServicesImages;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class AttributesOptionsController extends Controller
{
    public $layout = 'admin';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'add', 'edit', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    public function actionDelete($id)
    {
        $model = AttributeOptions::findOne(['id' => $id]);
        if ($model) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Option Deleted Successfly!');
            } else {
                Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
