<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Add Category Settings';
$form = ActiveForm::begin([
    'id' => 'form-category',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="container form-categories">
    <div class="toolbar">
        <h1 class="title">Add Category</h1>
    </div>
    <div class="row form-row">
        <div class="col-md-10 ms-auto pt-5">
            <div class="form-grid">
                <div class="controls">
                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'active')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select Option']); ?>
                    <?= $form->field($model, 'description')->textarea()
                    ?>

                    <?= $form->field($model, 'in_menu')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select Option']); ?>
                    <?php
                    if (count($model->categories_list) > 0) {
                        echo $form->field($model, 'parent')->dropDownList($model->categories_list, ['prompt' => 'No Parent']);
                    }
                    ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>