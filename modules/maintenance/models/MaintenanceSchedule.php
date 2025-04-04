<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "maintenance_schedule".
 *
 * @property int $schedule_id
 * @property int|null $equipment_id
 * @property int|null $technician_id
 * @property string|null $scheduled_date
 * @property int|null $type_id
 * @property int|null $frequency_id
 * @property int|null $status_id
 *
 * @property Equipment $equipment
 * @property Frequencies $frequency
 * @property MaintenanceLog[] $maintenanceLogs
 * @property ScheduleStatuses $status
 * @property Technician $technician
 * @property MaintenanceTypes $type
 */
class MaintenanceSchedule extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenance_schedule';
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
            [['equipment_id', 'technician_id', 'scheduled_date', 'type_id', 'frequency_id'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['equipment_id', 'technician_id', 'type_id', 'frequency_id', 'status_id'], 'integer'],
            [['scheduled_date'], 'safe'],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::class, 'targetAttribute' => ['equipment_id' => 'equipment_id']],
            [['technician_id'], 'exist', 'skipOnError' => true, 'targetClass' => Technician::class, 'targetAttribute' => ['technician_id' => 'technician_id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaintenanceTypes::class, 'targetAttribute' => ['type_id' => 'type_id']],
            [['frequency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Frequencies::class, 'targetAttribute' => ['frequency_id' => 'frequency_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScheduleStatuses::class, 'targetAttribute' => ['status_id' => 'status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'schedule_id' => Yii::t('app', 'Schedule ID'),
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'technician_id' => Yii::t('app', 'Technician ID'),
            'scheduled_date' => Yii::t('app', 'Scheduled Date'),
            'type_id' => Yii::t('app', 'Type ID'),
            'frequency_id' => Yii::t('app', 'Frequency ID'),
            'status_id' => Yii::t('app', 'Status ID'),
        ];
    }

    /**
     * Gets query for [[Equipment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipment::class, ['equipment_id' => 'equipment_id']);
    }

    /**
     * Gets query for [[Frequency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrequency()
    {
        return $this->hasOne(Frequencies::class, ['frequency_id' => 'frequency_id']);
    }

    /**
     * Gets query for [[MaintenanceLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, ['schedule_id' => 'schedule_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ScheduleStatuses::class, ['status_id' => 'status_id']);
    }

    /**
     * Gets query for [[Technician]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTechnician()
    {
        return $this->hasOne(Technician::class, ['technician_id' => 'technician_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(MaintenanceTypes::class, ['type_id' => 'type_id']);
    }

}
