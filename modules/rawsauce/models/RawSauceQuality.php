<?php

namespace app\modules\rawsauce\models;

use Yii;

/**
 * This is the model class for table "raw_sauce_quality".
 *
 * @property int $id
 * @property int $log_id บันทึกซีอิ้วดิบ
 * @property string|null $qc_by ผู้บันทึก
 * @property string|null $qc_date วันที่บันทึก
 * @property string|null $sediment
 * @property string|null $color_value ค่าสี
 * @property string|null $color_ratio สัดส่วนสี
 * @property string|null $nacl_value ค่าเกลือ
 * @property string|null $ph_value ค่า pH
 * @property string|null $alcohol_value ค่า Alcohol
 * @property string|null $tn_value ค่า TN
 * @property string|null $brix_value ค่า Brix
 * @property string|null $ncr อ้างอิง NCR
 * @property string|null $remask หมายเหตุ
 * @property string $ref_code
 */
class RawSauceQuality extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raw_sauce_quality';
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
            [['qc_by', 'qc_date', 'sediment', 'color_value', 'color_ratio', 'nacl_value', 'ph_value', 'alcohol_value', 'tn_value', 'brix_value', 'ncr', 'remask'], 'default', 'value' => null],
            [['log_id', 'ref_code'], 'required'],
            [['log_id'], 'integer'],
            [['qc_by', 'remask'], 'string', 'max' => 100],
            [['qc_date', 'sediment', 'color_value', 'color_ratio', 'nacl_value', 'ph_value', 'alcohol_value', 'tn_value', 'brix_value', 'ncr', 'ref_code'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'log_id' => Yii::t('app', 'บันทึกซีอิ้วดิบ'),
            'qc_by' => Yii::t('app', 'ผู้บันทึก'),
            'qc_date' => Yii::t('app', 'วันที่บันทึก'),
            'sediment' => Yii::t('app', 'Sediment'),
            'color_value' => Yii::t('app', 'ค่าสี'),
            'color_ratio' => Yii::t('app', 'สัดส่วนสี'),
            'nacl_value' => Yii::t('app', 'ค่าเกลือ'),
            'ph_value' => Yii::t('app', 'ค่า pH'),
            'alcohol_value' => Yii::t('app', 'ค่า Alcohol'),
            'tn_value' => Yii::t('app', 'ค่า TN'),
            'brix_value' => Yii::t('app', 'ค่า Brix'),
            'ncr' => Yii::t('app', 'อ้างอิง NCR'),
            'remask' => Yii::t('app', 'หมายเหตุ'),
            'ref_code' => Yii::t('app', 'Ref Code'),
        ];
    }

}
