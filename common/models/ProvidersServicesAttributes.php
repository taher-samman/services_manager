<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "providers_services_attributes".
 *
 * @property int $id
 * @property int|null $entity_id
 * @property int|null $attribute
 * @property string|null $option
 * @property float|null $price
 *
 * @property Attributes $attribute0
 * @property ProvidersServices $entity
 */
class ProvidersServicesAttributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'providers_services_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'attribute'], 'integer'],
            [['price'], 'number'],
            [['option'], 'string', 'max' => 255],
            [['entity_id', 'attribute'], 'unique', 'targetAttribute' => ['entity_id', 'attribute']],
            [['attribute'], 'exist', 'skipOnError' => true, 'targetClass' => Attributes::class, 'targetAttribute' => ['attribute' => 'id']],
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
            'attribute' => 'Attribute',
            'option' => 'Option',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attributes::class, ['id' => 'attribute']);
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
}
