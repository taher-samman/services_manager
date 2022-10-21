<?php

namespace common\behaviors;

use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;
use yii\db\BaseActiveRecord;


class ProviderServicePriceBehavior extends \yii\behaviors\AttributeBehavior
{
    public function __get($name)
    {
        if (strcmp($name, 'prices') == 0) {
            $attributes = $this->owner->providersServicesAttributes;
            $price = (float)$this->owner->price;
            foreach ($attributes as $attribute) {
                $price += (float)$attribute->price;
            }
            return number_format($price) . ' LBP';
        }
    }
    public function canGetProperty($name, $checkVars = true)
    {
        if (strcmp($name, 'prices') == 0) {
            return true;
        }
    }
}
