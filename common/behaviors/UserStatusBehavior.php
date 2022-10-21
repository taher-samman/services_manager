<?php

namespace common\behaviors;

use common\models\ProvidersServices;
use common\models\User;
use Yii;


class UserStatusBehavior extends \yii\behaviors\AttributeBehavior
{
    public function __get($name)
    {
        if (strcmp($name, 'status_label') == 0) {
            switch ($this->owner->status) {
                case User::STATUS_DELETED:
                    return 'Deleted';
                    break;
                case User::STATUS_INACTIVE:
                    return 'Inactive';
                    break;
                case User::STATUS_ACTIVE:
                    return 'Active';
                    break;
            }
        }
    }
    public function canGetProperty($name, $checkVars = true)
    {
        if (strcmp($name, 'status_label') == 0) {
            return true;
        }
    }
}
