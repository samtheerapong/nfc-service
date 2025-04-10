<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "monitors".
 *
 * @property int $id
 * @property int $computer_id
 * @property string|null $asset_code รหัสสินทรัพย์
 * @property string $monitor_name ชื่อ
 * @property string|null $monitor_type ประเภทจอ
 * @property float|null $screen_size_inch ขนาดจอ
 * @property int $connectivity_types_id การเชื่อมต่อ
 * @property string|null $brand ยี่ห้อ
 * @property string|null $model รุ่น
 * @property string|null $serial_number
 * @property string|null $purchase_date วันที่ซื้อ
 * @property string|null $warranty_expiry วันหมดอายุ
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status_id สถานะ
 * @property string|null $ref_code
 *
 * @property Computers $computer
 * @property ConnectivityTypes $connectivityTypes
 * @property Status $status
 */
class Monitors extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monitors';
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
            [['asset_code', 'monitor_type', 'screen_size_inch', 'brand', 'model', 'serial_number', 'purchase_date', 'warranty_expiry', 'created_at', 'updated_at', 'ref_code'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['computer_id', 'monitor_name', 'connectivity_types_id'], 'required'],
            [['computer_id', 'connectivity_types_id', 'status_id'], 'integer'],
            [['screen_size_inch'], 'number'],
            [['asset_code', 'purchase_date', 'warranty_expiry', 'created_at', 'updated_at', 'ref_code'], 'string', 'max' => 45],
            [['monitor_name', 'monitor_type', 'brand', 'model', 'serial_number'], 'string', 'max' => 100],
            [['serial_number'], 'unique'],
            [['connectivity_types_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConnectivityTypes::class, 'targetAttribute' => ['connectivity_types_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['computer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Computers::class, 'targetAttribute' => ['computer_id' => 'id']],
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
            'asset_code' => Yii::t('app', 'รหัสสินทรัพย์'),
            'monitor_name' => Yii::t('app', 'ชื่อ'),
            'monitor_type' => Yii::t('app', 'ประเภทจอ'),
            'screen_size_inch' => Yii::t('app', 'ขนาดจอ'),
            'connectivity_types_id' => Yii::t('app', 'การเชื่อมต่อ'),
            'brand' => Yii::t('app', 'ยี่ห้อ'),
            'model' => Yii::t('app', 'รุ่น'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'purchase_date' => Yii::t('app', 'วันที่ซื้อ'),
            'warranty_expiry' => Yii::t('app', 'วันหมดอายุ'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status_id' => Yii::t('app', 'สถานะ'),
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
     * Gets query for [[ConnectivityTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConnectivityTypes()
    {
        return $this->hasOne(ConnectivityTypes::class, ['id' => 'connectivity_types_id']);
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
