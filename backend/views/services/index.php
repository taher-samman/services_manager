<?php

use common\models\Services;
use yii\helpers\Html;
use yii\helpers\Url;

$services = Services::find()->all();

if (count($services) > 0) { ?>
    <div class="card-group row">
        <?php foreach ($services as $key => $service) : ?>
            <div class="col-md-4">
                <div class="card h-100 <?= $service->active ? '' : 'border-danger'; ?> mb-3" style="display:flex;flex-direction:column">
                    <?= Html::img(Yii::getAlias("@images/services/$service->firstimage")); ?>
                    <div class="card-body mt-auto flex-grow-0">
                        <h5 class="card-title"><?= $service->name ?></h5>
                        <p class="card-text"><?= $service->description ?></p>
                        <p><b>Category:</b> <?= $service->category0->name ?></p>
                        <?= Html::a('Edit', ["services/edit/$service->id"], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
<?php } ?>