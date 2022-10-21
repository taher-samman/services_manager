<?php

namespace common\behaviors;

use common\models\ProvidersServices;
use yii\base\InvalidCallException;
use yii\db\BaseActiveRecord;

class FillProvidersServicesDetailsBehavior extends \yii\behaviors\AttributeBehavior
{
    public function events()
    {
        return [
            \yii\db\ActiveRecord::EVENT_AFTER_INSERT => 'refreshCache',
        ];
    }
    public function refreshCache($event)
    {
        \Yii::info('EVENT_AFTER_INSERT id: ' . $this->owner->id . ' price: ' . $this->owner->price, 'customlog');
        $this->delete();
    }
    public function delete()
    {
        ProvidersServices::findOne(['id' => $this->owner->id])->delete();
    }
}
