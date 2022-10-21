<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Site controller
 */
class UsersController extends Controller
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
                        'actions' => ['logout', 'activate', 'index', 'add', 'update', 'delete'],
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
    public function actionActivate($id)
    {
        $user = User::findOne($id);
        if (!empty($user)) {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'You Activate ' . $user->username);
            } else {
                Yii::$app->session->setFlash('error', 'Connat Activate ' . $user->username);
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (count($posts) > 0) {
                try {
                    if ($model->load($posts) && $model->save()) {
                        Yii::$app->session->setFlash('success', 'User Updated');
                        return $this->redirect(['/users/index']);
                    }
                    Yii::$app->session->setFlash('error', 'Connat Update User');
                } catch (\Throwable $e) {
                    throw $e;
                    Yii::$app->session->setFlash('error', $e);
                }
            }
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }
    public function actionDelete($id)
    {
        $model = User::findOne(['id' => $id]);
        if ($model) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'User Deleted Successfly!');
            } else {
                Yii::$app->session->setFlash('warning', 'One Thing Is Wrong!');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
