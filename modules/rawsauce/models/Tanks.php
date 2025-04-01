<?php

namespace app\modules\rawsauce\models;

use Yii;

/**
 * This is the model class for table "tanks".
 *
 * @property int $id
 * @property string|null $name ชื่อ
 * @property string|null $type ประเภทถัง
 * @property int|null $max_value ความจุสูงสุด
 * @property string|null $location สถานที่
 *
 * @property RawSauceLog[] $rawSauceLogs
 */
class Tanks extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tanks';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('rawsauce');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'max_value', 'location'], 'default', 'value' => null],
            [['max_value'], 'integer'],
            [['name', 'type', 'location'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชื่อ'),
            'type' => Yii::t('app', 'ประเภทถัง'),
            'max_value' => Yii::t('app', 'ความจุสูงสุด'),
            'location' => Yii::t('app', 'สถานที่'),
        ];
    }

    /**
     * Gets query for [[RawSauceLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawSauceLogs()
    {
        return $this->hasMany(RawSauceLog::class, ['tank_id' => 'id']);
    }

}
