<?php

namespace common\models;

use common\behaviors\GenerateAttributesBehavior;
use common\behaviors\ServiceAvailableBehavior;
use common\behaviors\ServiceBookAvailableBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $category
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Attributes[] $attributes0
 * @property Categories $category0
 */
class Services extends \yii\db\ActiveRecord
{
    const SCENARIO_FRONTEND = 'frontend';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category'], 'required'],
            [['description'], 'string'],
            [['category'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['active'], 'default', 'value' => 1],
            [['name'], 'string', 'max' => 255],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category' => 'id']],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_FRONTEND] = ['name', 'category', 'description', 'created_at', 'updated_at', 'active'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'category' => 'Category',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
                'attributes' => ['active_label']
            ],
            ServiceAvailableBehavior::class,
            ServiceBookAvailableBehavior::class,
        ];
    }
    /**
     * Gets query for [[Attributes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attributes::class, ['service' => 'id'])->all();
    }
    public function getProvidersServices()
    {
        return $this->hasMany(ProvidersServices::className(), ['service' => 'id']);
    }
    public function getImages()
    {
        return $this->hasMany(ServicesImages::class, ['service' => 'id'])->all();
    }
    public function getFirstimage()
    {
        $images = $this->images;
        foreach ($images as $image) {
            return $image->image;
        }
    }

    public function getCategory0()
    {
        return $this->hasOne(Categories::class, ['id' => 'category'])->one();
    }
    public function insertImage()
    {
        if (isset($_FILES['ServicesImages']['name']['image']) && strlen($_FILES['ServicesImages']['name']['image']) > 0) {
            $images = new ServicesImages();
            $images->service = $this->id;
            if ($images->save()) {
                Yii::$app->session->setFlash('success', 'Image Uploaded!');
            } else {
                Yii::$app->session->setFlash('error', 'Image Not Uploaded!');
            }
        } else {
            Yii::info('ma fi soura', 'customlog');
        }
    }
    public function afterSave($insert, $changedAttributes)
    {
        $this->insertImage();
        return parent::afterSave($insert, $changedAttributes);
    }
    public function afterFind()
    {
        // Yii::info('scenario: ' . $this->scenario, 'customlog');
        // if (strcmp($this->scenario, self::SCENARIO_FRONTEND) == 0) {
        if (!$this->checkCategory($this->category0)) {
            $this->active = 0;
        }
        // }
    }
    public function checkCategory($category)
    {
        if ($category->active === 0) {
            return false;
        }
        while ($category->parent !== null) {
            $category = Categories::findOne($category->parent);
            if ($category->active === 0) {
                return false;
            }
        }
        return true;
    }
}
