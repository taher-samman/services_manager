<?php

use common\components\ServiceAttributesWidget;
use common\components\ServiceSliderWidget;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

?>
<div class="service">
    <div class="row r-s">
        <div class="col-md-5 c-images">
            <?= ServiceSliderWidget::widget(['service' => $service]) ?>
        </div>
        <div class="col-md-6 ms-auto c-content">
            <div class="service-title">
                <h1><?= $service->name ?></h1>
            </div>
            <div class="service-content">
                <h3 class="id">#<?= $service->id ?></h3>
                <div class="category"><?= FA::icon('list-alt') . ' ' . $service->category0->name ?></div>
            </div>
            <p class="description"><?= $service->description ?></p>
            <h3 class="details"><?= FA::icon('info') ?> Details</h3>
            <div class="attributes">
                <?= ServiceAttributesWidget::widget(['service' => $service]) ?>
            </div>
            <div class="actions text-end">
                <?php
                if ($service->book_available) {
                    echo Html::a(FA::icon('plus') . ' Provide This Service', ['services/provide/' . $service->id], [
                        'class' => 'btn btn-success',
                        'data-confirm' => 'are u sure!',
                    ]);
                }
                ?>
            </div>
        </div>
    </div>
</div>






<!-- php yii migrate/create create_users_services_table --fields="entity_id:integer:foreignKey(providers_services):notNull,user:integer:foreignKey(user):notNull" -->
<!-- php yii migrate/create create_users_services_attributes_table --fields="entity_id:integer:foreignKey(providers_services_attributes):notNull,user:integer:foreignKey(user):notNull" -->
<!-- php yii migrate/create create_users_services_datetime_table --fields="entity_id:integer:foreignKey(users_services):notNull,day:integer:foreignKey(services_days):notNull,schedule:integer:foreignKey(schedules):notNull" -->