<?php

use common\models\AttributeTypes;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$types = [];
$has_options = [];
$result = AttributeTypes::find()->all();
foreach ($result as $key => $type) {
    $types[$type->id] = $type->name;
    $has_options[$type->id] = $type->has_options;
}
$this->title = 'Add Attribute Settings';
$form = ActiveForm::begin([
    'id' => 'form-attribute',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="container form-attributes">
    <div class="toolbar">
        <h1 class="title"><?= $this->title ?></h1>
    </div>
    <div class="row form-row">
        <div class="col-md-10 ms-auto pt-5">
            <div class="form-grid">
                <div class="controls">
                    <?= $form->field($model, 'service')->hiddenInput(['value' => $service])->label(false); ?>
                    <?= $form->field($model, 'type')->dropDownList($types, ['prompt' => 'Select Type', 'data-types' => json_encode($has_options)]); ?>
                    <?= $form->field($model, 'name')->textInput(); ?>
                    <div class="addoptions"></div>
                    <div class="options"></div>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>