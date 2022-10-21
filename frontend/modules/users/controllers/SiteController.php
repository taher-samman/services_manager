<?php

namespace frontend\modules\users\controllers;

use yii\web\Controller;

/**
 * Default controller for the `users` module
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
