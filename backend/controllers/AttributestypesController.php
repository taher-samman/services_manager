<?php

namespace backend\controllers;

use common\models\AttributeTypes;
use common\models\Categories;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class AttributestypesController extends Controller
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
                        'actions' => ['logout', 'index', 'add'],
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['model' => new AttributeTypes()]);
    }
    public function actionAdd()
    {
        $model = new AttributeTypes();
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (count($posts) > 0) {
                try {
                    if ($model->load($posts) && $model->save()) {
                        Yii::$app->session->setFlash('success', 'Type Added Successfly!');
                        return $this->redirect(['attributestypes/index']);
                    } else {
                        Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
                    }
                } catch (\Throwable $e) {
                    throw $e;
                    Yii::$app->session->setFlash('error', $e);
                }
            }
        }
        return $this->render('add', [
            'model' => $model
        ]);
    }
    // public function actionEdit($id)
    // {
    //     $model = Categories::findOne(['id' => $id]);
    //     if (Yii::$app->request->isPost) {
    //         $posts = Yii::$app->request->post();
    //         if (count($posts) > 0) {
    //             try {
    //                 if ($model->load($posts) && $model->save()) {
    //                     Yii::$app->session->setFlash('success', 'Category Updated Successfly!');
    //                     return $this->redirect(['categories/index']);
    //                 } else {
    //                     Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
    //                 }
    //             } catch (\Throwable $e) {
    //                 throw $e;
    //                 Yii::$app->session->setFlash('error', $e);
    //             }
    //         }
    //     }
    //     return $this->render('edit', [
    //         'model' => $model
    //     ]);
    // }
    // public function actionDelete($id)
    // {
    //     $model = Categories::findOne(['id' => $id]);
    //     if ($model) {
    //         if ($model->delete()) {
    //             Yii::$app->session->setFlash('success', 'Category Deleted Successfly!');
    //             return $this->redirect(['categories/index']);
    //         } else {
    //             Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
    //         }
    //     }
    //     return $this->render('edit', [
    //         'model' => $model
    //     ]);
    // }
}
