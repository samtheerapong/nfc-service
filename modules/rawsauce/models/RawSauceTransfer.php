<?php

namespace app\modules\rawsauce\models;

use Yii;

/**
 * This is the model class for table "raw_sauce_transfer".
 *
 * @property int $id
 * @property string|null $log_id บันทึก
 * @property int|null $incoming_tank
 * @property int|null $incoming_value
 * @property string|null $incoming_date
 * @property int|null $outgoing_tank
 * @property int|null $outgoing_value
 * @property string|null $outgoing_date
 * @property string|null $ref_code
 */
class RawSauceTransfer extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raw_sauce_transfer';
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
            [['log_id', 'incoming_tank', 'incoming_value', 'incoming_date', 'outgoing_tank', 'outgoing_value', 'outgoing_date', 'ref_code'], 'default', 'value' => null],
            [['id'], 'required'],
            [['id', 'incoming_tank', 'incoming_value', 'outgoing_tank', 'outgoing_value'], 'integer'],
            [['log_id', 'incoming_date', 'outgoing_date', 'ref_code'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'log_id' => Yii::t('app', 'บันทึก'),
            'incoming_tank' => Yii::t('app', 'Incoming Tank'),
            'incoming_value' => Yii::t('app', 'Incoming Value'),
            'incoming_date' => Yii::t('app', 'Incoming Date'),
            'outgoing_tank' => Yii::t('app', 'Outgoing Tank'),
            'outgoing_value' => Yii::t('app', 'Outgoing Value'),
            'outgoing_date' => Yii::t('app', 'Outgoing Date'),
            'ref_code' => Yii::t('app', 'Ref Code'),
        ];
    }

}
