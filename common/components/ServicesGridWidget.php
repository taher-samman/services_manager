<?php

namespace common\components;

use common\models\Services;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class ServicesGridWidget extends Widget
{
    public $grid;
    public $category = null;
    public function init()
    {
        parent::init();
        $this->grid = $this->getServices();
    }
    public function getServices()
    {
        $grid = '<div class="row">';
        $servicesHtml = '';
        if ($this->category != null) {
            $services = $this->category->services;
        } else {
            $services = Services::findAll(['active' => 1]);
        }
        foreach ($services as $service) {
            if ($service->active) {
                $servicesHtml .= '
                    <div class="col-md-4">
                    <div class="card h-100 mb-3" style="display:flex;flex-direction:column">
                        ' . Html::img(Yii::getAlias("@images/services/$service->firstimage")) . '
                        <div class="card-body mt-auto flex-grow-0">
                            <h5 class="card-title">' . $service->name . '</h5>
                            <p class="card-text">' . $service->description . '</p>
                            ' . Html::a('View', ["services/$service->id"], ['class' => 'btn btn-success']) . '
                        </div>
                    </div>
                </div>';
            }
        }

        if (strlen($servicesHtml) > 0) {
            $grid .= $servicesHtml;
        } else {
            $grid .= '<h1>Dont Has Services</h1>';
        }
        $grid .= '<div>';
        return $grid;
    }
    public function run()
    {
        return Html::decode($this->grid);
    }
}
