<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "printers".
 *
 * @property int $id
 * @property int $profile_id
 * @property string|null $asset_code รหัสสินทรัพย์
 * @property string $printer_name ชื่อ
 * @property int $connectivity_types_id การเชื่อมต่อ
 * @property string|null $brand ยี่ห้อ
 * @property string|null $model รุ่น
 * @property string|null $serial_number S/N
 * @property string|null $location สถานที่ติดตั้ง
 * @property string|null $purchase_date วันที่ซื้อ
 * @property string|null $warranty_expiry วันที่หมดประกัน
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status_id สถานะ
 * @property string|null $ref_code REF
 *
 * @property ConnectivityTypes $connectivityTypes
 * @property Profile $profile
 * @property Status $status
 */
class Printers extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'printers';
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
            [['asset_code', 'brand', 'model', 'serial_number', 'location', 'purchase_date', 'warranty_expiry', 'created_at', 'updated_at', 'ref_code'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['profile_id', 'printer_name', 'connectivity_types_id'], 'required'],
            [['profile_id', 'connectivity_types_id', 'status_id'], 'integer'],
            [['asset_code', 'purchase_date', 'warranty_expiry', 'created_at', 'updated_at', 'ref_code'], 'string', 'max' => 45],
            [['printer_name', 'brand', 'model', 'serial_number', 'location'], 'string', 'max' => 100],
            [['serial_number'], 'unique'],
            [['connectivity_types_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConnectivityTypes::class, 'targetAttribute' => ['connectivity_types_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'id']],
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
            'profile_id' => Yii::t('app', 'Profile ID'),
            'asset_code' => Yii::t('app', 'รหัสสินทรัพย์'),
            'printer_name' => Yii::t('app', 'ชื่อ'),
            'connectivity_types_id' => Yii::t('app', 'การเชื่อมต่อ'),
            'brand' => Yii::t('app', 'ยี่ห้อ'),
            'model' => Yii::t('app', 'รุ่น'),
            'serial_number' => Yii::t('app', 'S/N'),
            'location' => Yii::t('app', 'สถานที่ติดตั้ง'),
            'purchase_date' => Yii::t('app', 'วันที่ซื้อ'),
            'warranty_expiry' => Yii::t('app', 'วันที่หมดประกัน'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status_id' => Yii::t('app', 'สถานะ'),
            'ref_code' => Yii::t('app', 'REF'),
        ];
    }

    /**
     * Gets query for [[ConnectivityTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConnectivityTypes()
    {
        return $this->hasOne(ConnectivityTypes::class, ['id' => 'connectivity_types_id']);
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'profile_id']);
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

}
