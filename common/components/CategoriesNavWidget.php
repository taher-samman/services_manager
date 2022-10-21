<?php

namespace common\components;

use rmrevin\yii\fontawesome\FA;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class CategoriesNavWidget extends Widget
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
        $li_a = '';
        $ul = '';
        $categories = $this->model->find()
            ->where(['parent' => $parentId, 'active' => 1])
            ->all();
        if (!empty($categories) && count($categories) > 0) {
            foreach ($categories as $category) {
                $children = $this->getChildren($category->id);
                if (strlen($children) > 0) {
                    $li_a .= '<li class="parent"><a class="toggle-child" href="' . Url::toRoute('categories/' . $category->id) . '">' . $category->name . FA::icon('caret-down');
                } else {
                    $li_a .= '<li class=""><a class="" href="' . Url::toRoute('categories/' . $category->id) . '">' . $category->name;
                }
                $li_a .=  '</a>';
                $li_a .= $children;
                $li_a .= '</li>';
            }
        }
        if (strlen($li_a) > 0) {
            $ul .= '<ul class="menu">';
            $ul .= $li_a;
            $ul .= '</ul>';
        }

        $navbar = '
            <nav class="navbar categories-menu navbar-expand-lg p-0">
            <div class="container-fluid p-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    ' . $ul . '
                </div>
            </div>
            </nav>
        ';
        return $navbar;
    }
    public function getChildren($parentId)
    {
        $li_a = '';
        $ul = '';
        $categories = $this->model->find()
            ->where(['parent' => $parentId, 'active' => 1])
            ->all();
        if (!empty($categories) && count($categories) > 0) {
            foreach ($categories as $category) {
                $children = $this->getChildren($category->id);
                if (strlen($children) > 0) {
                    $li_a .= '<li class="parent"><a class="toggle-child" href="' . Url::toRoute('categories/' . $category->id) . '">' . $category->name . FA::icon('caret-down');
                } else {
                    $li_a .= '<li class=""><a class="" href="' . Url::toRoute('categories/' . $category->id) . '">' . $category->name;
                }
                $li_a .=  '</a>';
                $li_a .= $children;
                $li_a .= '</li>';
            }
        }
        if (strlen($li_a) > 0) {
            $ul .= '<ul class="child">';
            $ul .= $li_a;
            $ul .= '</ul>';
        }
        return $ul;
    }
    public function run()
    {
        return Html::decode($this->html);
    }
}
