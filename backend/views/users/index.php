<?php

use common\models\User;
use rmrevin\yii\fontawesome\FA;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$dataProvider = new ActiveDataProvider(
    ['query' => User::find()]
);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'email',
        [
            'label' => 'status_label',
            'value' => function ($model) {
                if ($model->status === User::STATUS_INACTIVE) {
                    return $model->status_label . ' ' . Html::a('Activate', ["users/activate/$model->id"], ['class' => 'btn btn-info', 'data-confirm' => 'are u sure']);
                } else {
                    return $model->status_label;
                }
            },
            'format' => 'raw'
        ],
        'type',
        'created_at',
        ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
    ]
]);
