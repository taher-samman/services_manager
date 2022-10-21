<?php

namespace backend\controllers;

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
class ServicesController extends Controller
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
                        'actions' => ['logout', 'index', 'add', 'edit', 'delete', 'delete-image'],
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
        return $this->render('index');
    }
    public function actionAdd()
    {
        $model = new Services();
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (count($posts) > 0) {
                try {
                    if ($model->load($posts) && $model->save()) {
                        Yii::$app->session->setFlash('success', 'Service Added Successfly!');
                        return $this->redirect(['services/index']);
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
            'model' => $model,
            'images' => new ServicesImages()
        ]);
    }
    public function actionEdit($id)
    {
        $model = Services::findOne(['id' => $id]);
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (count($posts) > 0) {
                try {
                    if ($model->load($posts) && $model->save()) {
                        Yii::$app->session->setFlash('success', 'Category Updated Successfly!');
                        if (!isset($posts['continue'])) {
                            return $this->redirect(['services/index']);
                        }
                    } else {
                        Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
                    }
                } catch (\Throwable $e) {
                    throw $e;
                    Yii::$app->session->setFlash('error', $e);
                }
            }
        }
        return $this->render('edit', [
            'model' => $model,
            'images' => new ServicesImages()
        ]);
    }
    public function actionDelete($id)
    {
        $model = Services::findOne(['id' => $id]);
        if ($model) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Service Deleted Successfly!');
                return $this->redirect(['services/index']);
            } else {
                Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionDeleteImage($id)
    {
        $model = ServicesImages::findOne(['id' => $id]);
        if ($model) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Image Deleted Successfly!');
            } else {
                Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
