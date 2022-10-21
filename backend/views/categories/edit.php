<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Category';
$form = ActiveForm::begin([
    'id' => 'form-category',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="container form-categories">
    <div class="toolbar">
        <h1 class="title"><?= $this->title ?></h1>
    </div>
    <div class="row form-row">
        <div class="col-md-10 ms-auto pt-5">
            <div class="form-grid">
                <div class="controls">
                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'active')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select Option']); ?>
                    <?= $form->field($model, 'description')->textarea() ?>
                    <?= $form->field($model, 'in_menu')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select Option']); ?>
                    <?php
                    if (count($model->categories_list) > 0) {
                        echo $form->field($model, 'parent')->dropDownList($model->categories_list, ['prompt' => 'No Parent']);
                    }
                    ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ["categories/delete/$model->id"], [
                        'class' => 'btn btn-danger',
                        'data-confirm' => Yii::t('app', 'Are you sure you want to delete this Category?')
                    ]); ?>
                    <?= Html::a('Back', ["categories/index"], [
                        'class' => 'btn btn-warning',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>