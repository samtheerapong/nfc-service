<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property int $equipment_id
 * @property string $equipment_name
 * @property string|null $serial_number
 * @property int|null $type_id
 * @property string|null $purchase_date
 * @property string|null $warranty_end_date
 * @property string|null $location
 * @property int|null $status_id
 *
 * @property MaintenanceLog[] $maintenanceLogs
 * @property MaintenanceSchedule[] $maintenanceSchedules
 * @property EquipmentStatuses $status
 * @property EquipmentTypes $type
 */
class Equipment extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbpm');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['serial_number', 'type_id', 'purchase_date', 'warranty_end_date', 'location'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['equipment_name'], 'required'],
            [['type_id', 'status_id'], 'integer'],
            [['purchase_date', 'warranty_end_date'], 'safe'],
            [['equipment_name', 'location'], 'string', 'max' => 100],
            [['serial_number', 'asset_code'], 'string', 'max' => 45],
            [['serial_number'], 'unique'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipmentTypes::class, 'targetAttribute' => ['type_id' => 'type_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => EquipmentStatuses::class, 'targetAttribute' => ['status_id' => 'status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'equipment_id' => Yii::t('app', 'ID'),
            'equipment_name' => Yii::t('app', 'ชื่ออุปกรณ์'),
            'asset_code' => Yii::t('app', 'รหัสสินทรัพย์'),
            'serial_number' => Yii::t('app', 'S/N'),
            'type_id' => Yii::t('app', 'ประเภทอุปกรณ์'),
            'purchase_date' => Yii::t('app', 'วันที่ซื้อ'),
            'warranty_end_date' => Yii::t('app', 'หมดอายุประกัน'),
            'location' => Yii::t('app', 'สถานที่'),
            'status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[MaintenanceLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, ['equipment_id' => 'equipment_id']);
    }

    /**
     * Gets query for [[MaintenanceSchedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, ['equipment_id' => 'equipment_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(EquipmentStatuses::class, ['status_id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(EquipmentTypes::class, ['type_id' => 'type_id']);
    }
}
