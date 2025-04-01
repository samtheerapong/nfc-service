<?php

namespace app\modules\rawsauce\models;

use Yii;

/**
 * This is the model class for table "std_sauce".
 *
 * @property int $id
 * @property string|null $name ชื่อ
 * @property string|null $sauce_type ประเภท
 * @property string|null $std_ph มาตรฐาน PH
 * @property string|null $std_nacl
 * @property string|null $std_tn
 * @property string|null $std_color
 * @property string|null $std_alcohol
 * @property string|null $std_ppm
 * @property string|null $std_brix
 * @property string|null $remask
 *
 * @property RawSauceLog[] $rawSauceLogs
 */
class StdSauce extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_sauce';
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
            [['name', 'sauce_type', 'std_ph', 'std_nacl', 'std_tn', 'std_color', 'std_alcohol', 'std_ppm', 'std_brix', 'remask'], 'default', 'value' => null],
            [['name', 'remask'], 'string', 'max' => 100],
            [['sauce_type', 'std_ph', 'std_nacl', 'std_tn', 'std_color', 'std_alcohol', 'std_ppm', 'std_brix'], 'string', 'max' => 45],
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
            'sauce_type' => Yii::t('app', 'ประเภท'),
            'std_ph' => Yii::t('app', 'มาตรฐาน PH'),
            'std_nacl' => Yii::t('app', 'Std Nacl'),
            'std_tn' => Yii::t('app', 'Std Tn'),
            'std_color' => Yii::t('app', 'Std Color'),
            'std_alcohol' => Yii::t('app', 'Std Alcohol'),
            'std_ppm' => Yii::t('app', 'Std Ppm'),
            'std_brix' => Yii::t('app', 'Std Brix'),
            'remask' => Yii::t('app', 'Remask'),
        ];
    }

    /**
     * Gets query for [[RawSauceLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawSauceLogs()
    {
        return $this->hasMany(RawSauceLog::class, ['sauce_type_id' => 'id']);
    }

}
