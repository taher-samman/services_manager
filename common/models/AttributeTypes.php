<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attribute_types".
 *
 * @property int $id
 * @property string $name
 * @property string $html_value
 * @property int|null $has_options
 *
 * @property Attributes[] $attributes0
 */
class AttributeTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'html_value'], 'required'],
            [['has_options'], 'integer'],
            [['name', 'html_value'], 'string', 'max' => 255],
            [['html_value'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'html_value' => 'Html Value',
            'has_options' => 'Has Options',
        ];
    }

    /**
     * Gets query for [[Attributes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attributes::class, ['type' => 'id']);
    }
}
