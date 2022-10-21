<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "services_days".
 *
 * @property int $id
 * @property int $entity_id
 * @property string $day
 * @property int $duration
 * @property string $from
 * @property string $to
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProvidersServices $entity
 * @property Schedules[] $schedules
 */
class ServicesDays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services_days';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('Y-m-d H:i:s');
                }
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[ProvidersServices::SCENARIO_INIT] = ['entity_id', 'day', 'duration', 'from', 'to', 'created_at', 'updated_at'];
        return $scenarios;
    }
    public function rules()
    {
        return [
            [['entity_id', 'day', 'duration', 'from', 'to'], 'required'],
            [['entity_id', 'duration'], 'integer'],
            [['day', 'from', 'to', 'created_at', 'updated_at'], 'safe'],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProvidersServices::class, 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'day' => 'Day',
            'duration' => 'Duration',
            'from' => 'From',
            'to' => 'To',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Entity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(ProvidersServices::class, ['id' => 'entity_id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedules::class, ['day' => 'id']);
    }
    public function fillSchedules()
    {
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (isset($posts['ServicesDays'])) {
                $duration = $this->duration * 60;
                $start = strtotime($this->from);
                $end = strtotime($this->to);
                $time = $start;
                while ($time + $duration <= $end) {
                    $model = new Schedules();
                    $model->day = $this->id;
                    $model->setScenario(ProvidersServices::SCENARIO_INIT);
                    $model->from = date('H:i:s', $time);
                    $model->to = date('H:i:s', $time + $duration);
                    $model->duration = $this->duration;
                    if (!$model->save()) {
                        return false;
                    }
                    $time = $time + $duration;
                }
            }
        }
        return true;
    }
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->scenario === ProvidersServices::SCENARIO_INIT) {
            if (!$this->fillSchedules()) {
                Yii::$app->session->removeAllFlashes();
                Yii::$app->session->setFlash('error', 'provided');
                $this->delete();
                return;
            }
            Yii::$app->session->removeAllFlashes();
            Yii::$app->session->setFlash('success', 'provided');
        }

        return parent::afterSave($insert, $changedAttributes);
    }
    public function beforeDelete()
    {
        if ($this->scenario === ProvidersServices::SCENARIO_INIT) {
            $provider = ProvidersServices::findOne(['id' => $this->entity_id]);
            $provider->delete();
        }
        return parent::beforeDelete();
    }
}
