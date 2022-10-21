<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use common\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Update User';
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(['id' => 'update-user-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'status')->dropDownList(
            [
                User::STATUS_ACTIVE => 'Active',
                User::STATUS_INACTIVE => 'Disabled',
                User::STATUS_DELETED => 'Deleted',
            ]
        ); ?>
        <?= $form->field($model, 'password')->passwordInput()->label('New Password'); ?>

        <div class="form-group">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Back', ["users/index"], [
                'class' => 'btn btn-warning m-1',
            ]); ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>