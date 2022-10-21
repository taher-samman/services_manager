<?php

namespace common\behaviors;

use common\models\ProvidersServices;
use Yii;
use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;
use yii\db\BaseActiveRecord;


class ServiceBookAvailableBehavior extends \yii\behaviors\AttributeBehavior
{
    public function __get($name)
    {
        if (strcmp($name, 'book_available') == 0) {
            // $provider = ProvidersServices::findOne(['user' => Yii::$app->user->identity->id, 'service' => $this->owner->id]);
            // if (empty($provider)) {
            return true;
            // }
            // return false;
        }
    }
    public function canGetProperty($name, $checkVars = true)
    {
        if (strcmp($name, 'book_available') == 0) {
            return true;
        }
    }
}
