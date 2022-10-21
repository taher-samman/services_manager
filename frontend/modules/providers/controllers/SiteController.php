<?php

namespace frontend\modules\providers\controllers;

use common\models\Categories;
use common\models\Locations;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `modules` module
 */
class SiteController extends Controller
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
}
