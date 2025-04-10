<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "accessories".
 *
 * @property int $id
 * @property int $computer_id
 * @property string|null $asset_code
 * @property int|null $type_id
 * @property string $accessory_name ส่วนประกอบ
 * @property string|null $brand ยี่ห้อ
 * @property string|null $model รุ่น
 * @property string|null $serial_number S/N
 * @property string|null $purchase_date วันที่ซื้อ
 * @property string|null $warranty_expiry วันที่หมดประกัน
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status_id รหัสสินทรัพย์
 * @property string|null $ref_code
 *
 * @property Computers $computer
 * @property Status $status
 * @property AccessoryTypes $type
 */
class Accessories extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accessories';
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
            [['asset_code', 'type_id', 'brand', 'model', 'serial_number', 'purchase_date', 'warranty_expiry', 'created_at', 'updated_at', 'ref_code'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['computer_id', 'accessory_name'], 'required'],
            [['computer_id', 'type_id', 'status_id'], 'integer'],
            [['asset_code', 'purchase_date', 'warranty_expiry', 'created_at', 'updated_at', 'ref_code'], 'string', 'max' => 45],
            [['accessory_name', 'brand', 'model', 'serial_number'], 'string', 'max' => 100],
            [['serial_number'], 'unique'],
            [['computer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Computers::class, 'targetAttribute' => ['computer_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AccessoryTypes::class, 'targetAttribute' => ['type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'computer_id' => Yii::t('app', 'Computer ID'),
            'asset_code' => Yii::t('app', 'Asset Code'),
            'type_id' => Yii::t('app', 'Type ID'),
            'accessory_name' => Yii::t('app', 'ส่วนประกอบ'),
            'brand' => Yii::t('app', 'ยี่ห้อ'),
            'model' => Yii::t('app', 'รุ่น'),
            'serial_number' => Yii::t('app', 'S/N'),
            'purchase_date' => Yii::t('app', 'วันที่ซื้อ'),
            'warranty_expiry' => Yii::t('app', 'วันที่หมดประกัน'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status_id' => Yii::t('app', 'รหัสสินทรัพย์'),
            'ref_code' => Yii::t('app', 'Ref Code'),
        ];
    }

    /**
     * Gets query for [[Computer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputer()
    {
        return $this->hasOne(Computers::class, ['id' => 'computer_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AccessoryTypes::class, ['id' => 'type_id']);
    }

}
