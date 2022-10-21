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
class ServicesController extends Controller
{

    public $layout = 'main';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id)
    {
        $service = Services::findOne(['id' => $id]);
        if (!empty($service)) {
            return $this->render('index', ['service' => $service]);
        }
        return $this->redirect('notfound/index');
    }

    public function actionProvide($id)
    {
        $model = new ProvidersServices();
        $service = Services::findOne(['id' => $id]);
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if ($model->load($posts)) {
                $model->setScenario(ProvidersServices::SCENARIO_INIT);
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'provided');
                    return $this->redirect(['services/' . $id]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'provided');
            }
        }
        return $this->render('provide', [
            'service' => $service,
            'model' => $model,
            'modelAttributes' => new ProvidersServicesAttributes(),
            'days' => new ServicesDays()
        ]);
    }
    public function actionTest()
    {
        return 'test';
    }
}
