<?php

namespace app\modules\rawsauce\models;

use Yii;

/**
 * This is the model class for table "raw_sauce_log".
 *
 * @property int $id
 * @property int|null $tank_id หมายเลขถัง
 * @property string|null $ref_code รหัส
 * @property string|null $batch แบทซ์
 * @property int|null $current_value ปริมาตร
 * @property int|null $sauce_type_id ประเภทน้ำ
 * @property string|null $record_by ผู้บันทึก
 * @property string|null $updated_date วันที่บันทึกล่าสุด
 * @property int|null $incoming_value ปริมาตรขาเข้า
 * @property string|null $incoming_date วันที่ขาเข้า
 * @property int|null $outgoing_value ปริมาตรขาออก
 * @property string|null $outgoing_date วันที่ขาออก
 * @property string|null $remask หมายเหตุ
 *
 * @property StdSauce $sauceType
 * @property Tanks $tank
 */
class RawSauceLog extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raw_sauce_log';
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
            [['tank_id', 'ref_code', 'batch', 'current_value', 'sauce_type_id', 'record_by', 'updated_date', 'incoming_value', 'incoming_date', 'outgoing_value', 'outgoing_date', 'remask'], 'default', 'value' => null],
            [['tank_id', 'current_value', 'sauce_type_id', 'incoming_value', 'outgoing_value'], 'integer'],
            [['remask'], 'string'],
            [['ref_code', 'batch', 'record_by', 'updated_date', 'incoming_date', 'outgoing_date'], 'string', 'max' => 45],
            [['sauce_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StdSauce::class, 'targetAttribute' => ['sauce_type_id' => 'id']],
            [['tank_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tanks::class, 'targetAttribute' => ['tank_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tank_id' => Yii::t('app', 'หมายเลขถัง'),
            'ref_code' => Yii::t('app', 'รหัส'),
            'batch' => Yii::t('app', 'แบทซ์'),
            'current_value' => Yii::t('app', 'ปริมาตร'),
            'sauce_type_id' => Yii::t('app', 'ประเภทน้ำ'),
            'record_by' => Yii::t('app', 'ผู้บันทึก'),
            'updated_date' => Yii::t('app', 'วันที่บันทึกล่าสุด'),
            'incoming_value' => Yii::t('app', 'ปริมาตรขาเข้า'),
            'incoming_date' => Yii::t('app', 'วันที่ขาเข้า'),
            'outgoing_value' => Yii::t('app', 'ปริมาตรขาออก'),
            'outgoing_date' => Yii::t('app', 'วันที่ขาออก'),
            'remask' => Yii::t('app', 'หมายเหตุ'),
        ];
    }

    /**
     * Gets query for [[SauceType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSauceType()
    {
        return $this->hasOne(StdSauce::class, ['id' => 'sauce_type_id']);
    }

    /**
     * Gets query for [[Tank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTank()
    {
        return $this->hasOne(Tanks::class, ['id' => 'tank_id']);
    }

}
