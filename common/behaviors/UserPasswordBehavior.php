<?php

namespace common\behaviors;

use common\models\ProvidersServices;
use common\models\User;
use Yii;
use yii\base\InvalidCallException;
use yii\db\BaseActiveRecord;

class UserPasswordBehavior extends \yii\behaviors\AttributeBehavior
{
    public function __get($name)
    {
        if (strcmp($name, 'password') == 0) {
            return '';
        }
    }
    public function canGetProperty($name, $checkVars = true)
    {
        if (strcmp($name, 'password') == 0) {
            return true;
        }
    }
}
