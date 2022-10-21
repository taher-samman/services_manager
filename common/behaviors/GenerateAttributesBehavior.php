<?php

namespace common\behaviors;

use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;
use yii\db\BaseActiveRecord;

use function PHPUnit\Framework\returnSelf;

class GenerateAttributesBehavior extends \yii\behaviors\AttributeBehavior
{
    public $attributes;

    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_AFTER_FIND => [$this->attributes],
            ];
        }
    }

    public function __get($name)
    {
        foreach ($this->attributes as $attribute) {
            if ($name === $attribute) {
                if ($name === 'categories_list') {
                    if ($this->owner->id > 0) {
                        $categories = $this->owner->find()->where('active LIKE :active and id NOT LIKE :id', ['active' => 1, 'id' => $this->owner->id])->all();
                    } else {
                        $categories = $this->owner->find()->where('active LIKE :active', ['active' => 1])->all();
                    }
                    $result = [];
                    foreach ($categories as $category) {
                        $result[$category->id] = $category->name;
                    }
                    return $result;
                }
                if ($name === 'categoriesLabels') {
                    $categories = $this->owner->categories;
                    $result = [];
                    foreach ($categories as $key => $category) {
                        $result[$category->id] = $category->name;
                    }
                    return $result;
                }
                if ($name === 'categoriesIds') {
                    $categories = $this->owner->categories;
                    $result = [];
                    foreach ($categories as $key => $category) {
                        $result[] = $category->id;
                    }
                    return $result;
                }
                if ($name === 'products') {
                    $products = $this->owner->products;
                    return $products;
                }
                if ($name === 'final_price') {
                    $price = $this->owner->price;
                    $specialPrice = $this->owner->special_price;
                    $prices = [$price, $specialPrice];
                    $prices = array_filter($prices, function ($a) {
                        return ($a !== 0 && $a !== null);
                    });
                    return min($prices);
                }
                if ($name === 'latitude') {
                    return 'latitude';
                }
                if ($name === 'longitude') {
                    return 'longitude';
                }
                if ($name == 'active_label') {
                    switch ($this->owner->active) {
                        case 1:
                            return 'Active';
                            break;
                        case 0:
                            return 'Disabled';
                            break;
                    }
                }
            }
        }
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        }

        throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }
    public function canGetProperty($name, $checkVars = true)
    {
        foreach ($this->attributes as $attribute) {
            if ($name === $attribute) {
                return true;
            }
        }
    }
}
