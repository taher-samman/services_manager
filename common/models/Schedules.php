<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "schedules".
 *
 * @property int $id
 * @property int $day
 * @property string $from
 * @property string $to
 * @property int $duration
 * @property int|null $user
 * @property int|null $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ServicesDays $day0
 * @property User $user0
 */
class Schedules extends \yii\db\ActiveRecord
{

    const AVAILABLE = 'available';
    const UNAVAILABLE = 'unavailable';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedules';
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
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[ProvidersServices::SCENARIO_INIT] = ['user', 'status', 'day', 'duration', 'from', 'to', 'created_at', 'updated_at'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day', 'from', 'to', 'duration'], 'required'],
            [['day', 'duration', 'user', 'status'], 'integer'],
            [['status'], 'default', 'value' => self::AVAILABLE],
            [['from', 'to', 'created_at', 'updated_at'], 'safe'],
            [['day'], 'exist', 'skipOnError' => true, 'targetClass' => ServicesDays::class, 'targetAttribute' => ['day' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day' => 'Day',
            'from' => 'From',
            'to' => 'To',
            'duration' => 'Duration',
            'user' => 'User',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Day0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDay0()
    {
        return $this->hasOne(ServicesDays::class, ['id' => 'day']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'user']);
    }
}
