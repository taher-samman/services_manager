<?php

namespace common\components;

use common\models\Services;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class ServiceAttributesWidget extends Widget
{
    public $service;
    public $attributes;
    public function init()
    {
        parent::init();
        $this->attributes = $this->getAttributes();
    }
    public function getAttributes()
    {
        $attributesHtml = '';
        foreach ($this->service->attributes0 as $key => $attribute) {
            $attributesHtml .= '
                <div class="attribute">
                    <div class="name">
                        <p>' . $attribute->name . '</p>
                    </div>
            ';
            if ($attribute->type0->has_options) {
                $attributesHtml .= '<div class="options"><p>';
                foreach ($attribute->attributeOptions as $option) {
                    $attributesHtml .= '<span class="option"> ' . $option->value . ' </span>';
                }
                $attributesHtml .= '</p></div>';
            }
            $attributesHtml .= '</div>';
        }
        return $attributesHtml;
    }
    public function run()
    {
        return Html::decode($this->attributes);
    }
}
