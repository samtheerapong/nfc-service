<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "computers".
 *
 * @property int $id
 * @property int $profile_id ผู้ครอบครอง
 * @property string|null $asset_code รหัสสินทรัพย์
 * @property string $computer_name ชื่อคอมพิวเตอร์
 * @property string|null $brand ยี่ห้อ
 * @property string|null $model รุ่น
 * @property string|null $serial_number S/N
 * @property string|null $purchase_date วันที่ซื้อ
 * @property string|null $warranty_expiry วันหมดอายุ
 * @property string|null $cpu ซีพียู
 * @property string|null $ram แรม
 * @property string|null $capacity_storage ความจุ
 * @property string|null $lan LAN:
 * @property string|null $wifi Wireless:
 * @property string|null $network_ip IP address:
 * @property string|null $nework_mac_addr MAC address:
 * @property int|null $status_id สถานะ
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $ref_code
 *
 * @property Accessories[] $accessories
 * @property Monitors[] $monitors
 * @property Profile $profile
 * @property Software[] $softwares
 * @property Status $status
 */
class Computers extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'computers';
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
            [['asset_code', 'brand', 'model', 'serial_number', 'purchase_date', 'warranty_expiry', 'cpu', 'ram', 'capacity_storage', 'lan', 'wifi', 'network_ip', 'nework_mac_addr', 'created_at', 'updated_at', 'ref_code'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['profile_id', 'computer_name'], 'required'],
            [['profile_id', 'status_id'], 'integer'],
            [['asset_code', 'purchase_date', 'warranty_expiry', 'cpu', 'ram', 'capacity_storage', 'lan', 'wifi', 'network_ip', 'nework_mac_addr', 'created_at', 'updated_at', 'ref_code'], 'string', 'max' => 45],
            [['computer_name', 'brand', 'model', 'serial_number'], 'string', 'max' => 100],
            [['serial_number'], 'unique'],
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
            'profile_id' => Yii::t('app', 'ผู้ครอบครอง'),
            'asset_code' => Yii::t('app', 'รหัสสินทรัพย์'),
            'computer_name' => Yii::t('app', 'ชื่อคอมพิวเตอร์'),
            'brand' => Yii::t('app', 'ยี่ห้อ'),
            'model' => Yii::t('app', 'รุ่น'),
            'serial_number' => Yii::t('app', 'S/N'),
            'purchase_date' => Yii::t('app', 'วันที่ซื้อ'),
            'warranty_expiry' => Yii::t('app', 'วันหมดอายุ'),
            'cpu' => Yii::t('app', 'ซีพียู'),
            'ram' => Yii::t('app', 'แรม'),
            'capacity_storage' => Yii::t('app', 'ความจุ'),
            'lan' => Yii::t('app', 'LAN:'),
            'wifi' => Yii::t('app', 'Wireless:'),
            'network_ip' => Yii::t('app', 'IP address:'),
            'nework_mac_addr' => Yii::t('app', 'MAC address:'),
            'status_id' => Yii::t('app', 'สถานะ'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ref_code' => Yii::t('app', 'Ref Code'),
        ];
    }

    /**
     * Gets query for [[Accessories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccessories()
    {
        return $this->hasMany(Accessories::class, ['computer_id' => 'id']);
    }

    /**
     * Gets query for [[Monitors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMonitors()
    {
        return $this->hasMany(Monitors::class, ['computer_id' => 'id']);
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
     * Gets query for [[Softwares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoftwares()
    {
        return $this->hasMany(Software::class, ['computer_id' => 'id']);
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
