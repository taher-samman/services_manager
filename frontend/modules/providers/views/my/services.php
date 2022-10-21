<?php

use common\models\ProvidersServices;
use common\models\Services;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

$user = User::findOne(['id' => Yii::$app->user->identity->id]);
?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">category</th>
            <th scope="col">Provided At</th>
            <th scope="col">Status</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($user->services as $key => $service) { ?>
            <tr>
                <th scope="row"><?= $service->name ?></th>
                <td><?= $service->category0->name ?></td>
                <td><?= $service->created_at ?></td>
                <td><?= $service->active_label ?></td>
                <?php foreach ($service->providersServices as $key => $providersService) { ?>
                    <td><?= $providersService->prices ?></td>
                <?php } ?>
                <td><?= Html::a('View', ['my/view/' . $service->id], ['class' => 'btn btn-success']) ?></td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>