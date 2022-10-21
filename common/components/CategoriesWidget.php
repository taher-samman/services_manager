<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class CategoriesWidget extends Widget
{
    public $html;
    public $model;
    public $parent;
    public function init()
    {
        parent::init();
        $this->html = $this->getCategories($this->parent);
    }
    public function getCategories($parentId)
    {
        $categories = $this->model->find()
            ->where(['parent' => $parentId])
            ->all();
        $html = '<ul>';
        foreach ($categories as $category) {
            $html .= '<li><a class="link-success text-decoration-none" href="' . Url::toRoute('categories/edit/' . $category->id) . '">';
            $html .= $category->name;
            $html .= $this->getCategories($category->id);
            $html .= '</li></a>';
        }
        $html .= '</ul>';
        return $html;
    }
    public function run()
    {
        return Html::decode($this->html);
    }
}
