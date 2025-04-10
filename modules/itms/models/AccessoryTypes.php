<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "accessory_types".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $color
 *
 * @property Accessories[] $accessories
 */
class AccessoryTypes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accessory_types';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbit');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'color'], 'default', 'value' => null],
            [['name'], 'required'],
            [['description'], 'string'],
            [['name', 'color'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * Gets query for [[Accessories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccessories()
    {
        return $this->hasMany(Accessories::class, ['type_id' => 'id']);
    }

}
