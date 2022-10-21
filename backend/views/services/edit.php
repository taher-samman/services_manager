<?php

use common\models\Categories;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$result = Categories::find()->all();
$categories = [];
foreach ($result as $category) {
    $categories[$category->id] = $category->name;
}
$this->title = 'Edit Service';
$form = ActiveForm::begin([
    'id' => 'form-service',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="container form-services">
    <div class="toolbar">
        <h1 class="title"><?= $this->title ?></h1>
    </div>
    <div class="row form-row">
        <div class="col-md-6 pt-5">
            <div class="form-grid">
                <div class="controls">
                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'description')->textarea() ?>
                    <?= $form->field($model, 'active')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select Option']); ?>
                    <?= $form->field($model, 'category')->dropDownList($categories, ['prompt' => 'Shoose Category']); ?>
                    <?= $form->field($images, 'image')->fileInput(); ?>
                    <div class="actions d-flex pt-2">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary m-1']) ?>
                        <?= Html::submitButton('Save & Continue', ['class' => 'btn btn-success m-1', 'name' => 'continue']) ?>
                        <?= Html::a('Delete', ["services/delete/$model->id"], [
                            'class' => 'btn btn-danger m-1',
                            'data-confirm' => Yii::t('app', 'Are you sure you want to delete this Service?')
                        ]); ?>
                        <?= Html::a('Back', ["services/index"], [
                            'class' => 'btn btn-warning m-1',
                        ]); ?>
                        <?= Html::a('Add Attribute', ["attributes/add/$model->id"], [
                            'class' => 'btn btn-primary m-1 ms-auto',
                        ]); ?>
                    </div>
                    <div class="attributes row">
                        <?php foreach ($model->attributes0 as $key => $attribute) { ?>
                            <div class="col-md-6 attribute p-2 border border-info">
                                <div class="name">
                                    <h2 class="w-100 text-danger d-flex">
                                        <?= $attribute->name ?>
                                        <span class="ms-auto">
                                            <?= Html::a(FA::icon('trash'), ["attributes/delete/$attribute->id"], [
                                                'class' => 'btn btn-danger m-1',
                                                'data-confirm' => Yii::t('app', 'Are you sure you want to delete this Attribute?')
                                            ]); ?>
                                        </span>
                                    </h2>
                                    <?php if ($attribute->type0->has_options) { ?>
                                        <h4>Options:</h4>
                                        <?php foreach ($attribute->attributeOptions as $key => $option) { ?>
                                            <p class="mb-0 w-25 d-flex">
                                                <?= $option->value ?>
                                                <span class="ms-auto">
                                                    <?= Html::a(FA::icon('trash'), ["attributes-options/delete/$option->id"], [
                                                        'data-confirm' => Yii::t('app', 'Are you sure you want to delete this Option?')
                                                    ]); ?>
                                                </span>
                                            </p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="service-images row">
                <?php foreach ($model->images as $image) { ?>
                    <div class="col-md-3 pt-2">
                        <div class="image w-100">
                            <?= Html::a('X', ["services/delete-image/$image->id"], [
                                'class' => 'btn btn-danger',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to delete this Image?')
                            ]); ?>
                            <?= Html::img(Yii::getAlias("@images/services/$image->image"), ['class' => 'w-100']); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>