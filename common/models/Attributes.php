<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attributes".
 *
 * @property int $id
 * @property int $service
 * @property int $type
 * @property string $name
 *
 * @property AttributeOptions[] $attributeOptions
 * @property Services $service0
 * @property AttributeTypes $type0
 */
class Attributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service', 'type', 'name'], 'required'],
            [['service', 'type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['service'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['service' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeTypes::class, 'targetAttribute' => ['type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service' => 'Service',
            'type' => 'Type',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[AttributeOptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeOptions()
    {
        return $this->hasMany(AttributeOptions::class, ['attribute' => 'id'])->all();
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
     * Gets query for [[Type0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(AttributeTypes::class, ['id' => 'type']);
    }
    public function fillOptions()
    {
        $posts = Yii::$app->request->post();
        if (isset($posts['AttributeOptions']['value'])) {
            $values = $posts['AttributeOptions']['value'];
            foreach ($values as $value) {
                $options = new AttributeOptions();
                $options->attribute = $this->id;
                $options->value = $value;
                $options->save();
            }
        }
    }
    public function afterSave($insert, $changedAttributes)
    {
        $this->fillOptions();
        return parent::afterSave($insert, $changedAttributes);
    }
}
