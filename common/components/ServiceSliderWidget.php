<?php

namespace common\components;

use common\models\Services;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class ServiceSliderWidget extends Widget
{
    public $service;
    public $slider;
    public function init()
    {
        parent::init();
        $this->slider = $this->getSlider();
    }
    public function getSlider()
    {
        if (!empty($this->service)) {
            $images = [];
            foreach ($this->service->images as $image) {
                $images[] = Html::img(Yii::getAlias("@images/services/$image->image"), ['class' => 'w-100']);
            }
            return  \coderius\swiperslider\SwiperSlider::widget([
                'slides' => $images,
                'clientOptions' => [
                    'pagination' => false,
                ],
            ]);
        }
    }
    public function run()
    {
        return Html::decode($this->slider);
    }
}
