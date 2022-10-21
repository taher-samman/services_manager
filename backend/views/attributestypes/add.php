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
        <h1 class="title">Add Attribute Type</h1>
    </div>
    <div class="row form-row">
        <div class="col-md-10 ms-auto pt-5">
            <div class="form-grid">
                <div class="controls">
                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'html_value') ?>
                    <?= $form->field($model, 'has_options')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select Option']); ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>