<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use common\components\CategoriesWidget;
use common\models\Categories;

?>
<?php

function getCategories($model, $parentId)
{
    $categories = $model->find()
        ->where(['parent' => $parentId])
        ->all();
    $html = '<ul>';
    foreach ($categories as $category) {
        $html .= '<li><a class="link-success text-decoration-none" href="' . Url::toRoute('categories/edit/' . $category->id) . '">';
        $html .= $category->name;
        $html .= getCategories($model, $category->id);
        $html .= '</li></a>';
    }
    $html .= '</ul>';
    return $html;
}
?>

<div class="row flex-grow-1">
    <h1>Categories</h1>
    <div class="col-md-3">
        <?php //echo getCategories($model, null) 
        ?>

        <?= CategoriesWidget::widget(['model' => new Categories(), 'parent' => null]) ?>
    </div>
</div>