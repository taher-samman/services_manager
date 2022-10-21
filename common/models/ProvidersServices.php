<?php

namespace common\models;

use common\behaviors\FillProvidersServicesDetailsBehavior;
use common\behaviors\GenerateAttributesBehavior;
use common\behaviors\ProviderServicePriceBehavior;
use Yii;

/**
 * This is the model class for table "providers_services".
 *
 * @property int $id
 * @property int|null $user
 * @property int|null $service
 * @property float $price
 *
 * @property Attributes[] $attributes0
 * @property ProvidersServicesAttributes[] $providersServicesAttributes
 * @property Services $service0
 * @property User $user0
 */
class ProvidersServices extends \yii\db\ActiveRecord
{
    const SCENARIO_INIT = 'init';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'providers_services';
    }
    public function behaviors()
    {
        return [
            [
                'class' => ProviderServicePriceBehavior::class,
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INIT] = ['user', 'service', 'price'];
        return $scenarios;
    }
    public function rules()
    {
        return [
            [['user', 'service'], 'integer'],
            [['price'], 'required'],
            [['price'], 'number'],
            [['user'], 'default', 'value' => Yii::$app->user->identity->id],
            [['user', 'service'], 'unique', 'targetAttribute' => ['user', 'service']],
            [['service'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['service' => 'id']],
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
            'user' => 'User',
            'service' => 'Service',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Attributes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attributes::class, ['id' => 'attribute'])->viaTable('providers_services_attributes', ['entity_id' => 'id']);
    }

    /**
     * Gets query for [[ProvidersServicesAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvidersServicesAttributes()
    {
        return $this->hasMany(ProvidersServicesAttributes::class, ['entity_id' => 'id']);
    }

    /**
     * Gets query for [[Service0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService0()
    {
        return $this->hasOne(Services::class, ['id' => 'service']);
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
    public function fillAttributes()
    {
        $attributes = [];
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (isset($posts['ProvidersServicesAttributes'])) {
                $providers = $posts['ProvidersServicesAttributes'];
                foreach ($providers['attribute'] as $key => $attribute) {
                    $attributes[$attribute]['price'] = $providers['price'][$attribute];
                    if (isset($providers['option'][$attribute])) {
                        $attributes[$attribute]['option'] = $providers['option'][$attribute];
                    }
                }
                foreach ($attributes as $key => $value) {
                    $model = new ProvidersServicesAttributes();
                    $model->entity_id = $this->id;
                    $model->attribute = $key;
                    $model->price = $value['price'];
                    if (isset($value['option'])) {
                        $model->option = $value['option'];
                    }
                    if (!$model->save()) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
    public function fillCalendar()
    {
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (isset($posts['ServicesDays'])) {
                $servicesDays = $posts['ServicesDays'];
                $days = explode(',', $servicesDays['day']);
                foreach ($days as $day) {
                    $model = new ServicesDays();
                    $model->entity_id = $this->id;
                    $model->setScenario(ProvidersServices::SCENARIO_INIT);
                    $model->day = date('Y-m-d', strtotime($day));
                    $model->duration = $servicesDays['duration'];
                    $model->from = date('H:i:s', strtotime($servicesDays['from']));
                    $model->to = date('H:i:s', strtotime($servicesDays['to']));
                    if (!$model->save()) {
                        return false;
                    }
                }
            }
        }
        return true;
    }


    public function afterSave($insert, $changedAttributes)
    {
        if ($this->scenario === ProvidersServices::SCENARIO_INIT) {
            if (!$this->fillAttributes() || !$this->fillCalendar()) {
                Yii::$app->session->removeAllFlashes();
                Yii::$app->session->setFlash('error', 'provided');
                $this->delete();
                return;
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }
}
