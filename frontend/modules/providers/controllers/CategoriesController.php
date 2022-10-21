<?php

namespace frontend\modules\providers\controllers;

use common\models\Categories;
use yii\web\Controller;

/**
 * Default controller for the `modules` module
 */
class CategoriesController extends Controller
{
    public $layout = 'main';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id)
    {
        $category = Categories::findOne(['id' => $id]);
        return $this->render('/site/index', ['category' => $category]);
    }
}
