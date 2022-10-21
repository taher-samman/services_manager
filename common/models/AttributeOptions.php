<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attribute_options".
 *
 * @property int $id
 * @property int $attribute
 * @property string $value
 *
 * @property Attributes $attribute0
 */
class AttributeOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute', 'value'], 'required'],
            [['attribute'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['attribute'], 'exist', 'skipOnError' => true, 'targetClass' => Attributes::class, 'targetAttribute' => ['attribute' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute' => 'Attribute',
            'value' => 'Value',
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
}
