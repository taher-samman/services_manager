<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;

$this->title = 'Provide Service';
$form = ActiveForm::begin([
    'id' => 'form-provide',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="container form-provide">
    <div class="toolbar">
        <h1 class="title"><?= $this->title ?></h1>
    </div>
    <div class="row form-row">
        <div class="col-md-10 ms-auto pt-5">
            <div class="form-grid">
                <div class="controls">
                    <?= $form->field($model, 'service')->hiddenInput(['value' => $service->id])->label(false); ?>
                    <?= $form->field($model, 'price')->label('Service Price'); ?>

                    <?php
                    foreach ($service->attributes0 as $key => $attribute) { ?>
                        <div class="attribute row d-flex form-check form-switch">
                            <div class="col-md-3">
                                <?= $form->field($modelAttributes, 'attribute[' . $attribute->id . ']')->hiddenInput(['value' => $attribute->id, 'data-name' => 'ProvidersServicesAttributes[attribute][' . $attribute->id . ']'])->label($attribute->name); ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelAttributes, 'price[' . $attribute->id . ']')->textInput(['data-name' => 'ProvidersServicesAttributes[price][' . $attribute->id . ']'])->label('Price ' . $attribute->name); ?>
                            </div>
                            <div class="col-md-3">
                                <div class="checkbox">
                                    <input class="form-check-input  checkbox-attributes align-self-center" type="checkbox" id="flexSwitchCheckChecked" checked>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php if ($attribute->type0->has_options) {
                                    $options = [];
                                    foreach ($attribute->attributeOptions as $key => $option) {
                                        $options[$option->id] = $option->value;
                                    }
                                ?>
                                    <?= $form->field($modelAttributes, 'option[' . $attribute->id . ']')->dropDownList($options, ['data-name' => 'ProvidersServicesAttributes[option][' . $attribute->id . ']'])->label('Option') ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="calendar w-50">
                        <?= $form->field($days, 'day')->widget(DatePicker::classname(), [
                            'pluginOptions' => [
                                'multidate' => true,
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                            ],
                        ])->label('Available Days');
                        ?>
                        <label class="control-label">From Time</label>
                        <?= TimePicker::widget([
                            'model' => $days,
                            'attribute' => 'from',
                            'pluginOptions' => [
                                'showSeconds' => true,
                                'showMeridian' => false,
                                'secondStep' => 60
                            ]
                        ]);
                        ?>
                        <label class="control-label">To Time</label>
                        <?= TimePicker::widget([
                            'model' => $days,
                            'attribute' => 'to',
                            'pluginOptions' => [
                                'showSeconds' => true,
                                'showMeridian' => false,
                                'secondStep' => 60
                            ]
                        ]);
                        ?>
                        <?= $form->field($days, 'duration')->textInput(['type' => 'number'])->label('Service Duration'); ?>
                    </div>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>