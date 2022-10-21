<?php

namespace frontend\modules\providers\controllers;

use common\models\ServicesDays;
use common\models\Categories;
use common\models\ProvidersServices;
use common\models\ProvidersServicesAttributes;
use common\models\Services;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `modules` module
 */
class MyController extends Controller
{
    public $layout = 'main';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionServices()
    {
        return $this->render('services');
    }
    public function actionView($id)
    {
        $provider = ProvidersServices::findOne(['service' => $id]);
        return $this->render('view', ['provider' => $provider]);
    }
}
