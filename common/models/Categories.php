<?php

namespace common\models;

use common\behaviors\GenerateAttributesBehavior;
use Exception;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int|null $active
 * @property string|null $description
 * @property int|null $in_menu
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $parent
 *
 * @property Categories[] $categories
 * @property Categories $parent0
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active', 'in_menu', 'parent'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['parent' => 'id']],
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
            'active' => 'Active',
            'description' => 'Description',
            'in_menu' => 'In Menu',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'parent' => 'Parent',
        ];
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
            [
                'class' => GenerateAttributesBehavior::class,
                'attributes' => ['categories_list']
            ]
        ];
    }
    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['parent' => 'id'])->all();
    }
    public function getServices()
    {
        return $this->hasMany(Services::class, ['category' => 'id'])->all();
    }
    /**
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Categories::class, ['id' => 'parent']);
    }
}
