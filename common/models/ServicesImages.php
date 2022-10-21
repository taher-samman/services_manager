<?php

namespace common\models;

use Yii;
// use this cmd to instal UploaderBehavior: composer require --prefer-dist daxslab/yii2-uploader-behavior "*"
use daxslab\behaviors\UploaderBehavior;

/**
 * This is the model class for table "services_images".
 *
 * @property int $id
 * @property int $service
 * @property string $image
 *
 * @property Services $service0
 */
class ServicesImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service'], 'required'],
            [['service'], 'integer'],
            [['image'], 'file', 'skipOnError' => false, 'extensions' => 'png,jpg'],
            [['service'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['service' => 'id']],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => UploaderBehavior::className(),
                'attributes' => ['image'],
                'uploadPath' => '@static/images/services'
            ]
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
            'image' => 'Image',
        ];
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
}
