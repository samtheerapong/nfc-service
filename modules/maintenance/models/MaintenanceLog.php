<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "maintenance_log".
 *
 * @property int $log_id
 * @property int|null $schedule_id
 * @property int|null $equipment_id
 * @property int|null $technician_id
 * @property string|null $completed_date
 * @property string|null $description
 * @property int|null $result_id
 * @property string|null $notes
 *
 * @property Equipment $equipment
 * @property MaintenanceResults $result
 * @property MaintenanceSchedule $schedule
 * @property Technician $technician
 */
class MaintenanceLog extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenance_log';
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
            [['schedule_id', 'equipment_id', 'technician_id', 'completed_date', 'description', 'result_id', 'notes'], 'default', 'value' => null],
            [['schedule_id', 'equipment_id', 'technician_id', 'result_id'], 'integer'],
            [['completed_date'], 'safe'],
            [['description', 'notes'], 'string'],
            [['schedule_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaintenanceSchedule::class, 'targetAttribute' => ['schedule_id' => 'schedule_id']],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::class, 'targetAttribute' => ['equipment_id' => 'equipment_id']],
            [['technician_id'], 'exist', 'skipOnError' => true, 'targetClass' => Technician::class, 'targetAttribute' => ['technician_id' => 'technician_id']],
            [['result_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaintenanceResults::class, 'targetAttribute' => ['result_id' => 'result_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => Yii::t('app', 'Log ID'),
            'schedule_id' => Yii::t('app', 'Schedule ID'),
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'technician_id' => Yii::t('app', 'Technician ID'),
            'completed_date' => Yii::t('app', 'Completed Date'),
            'description' => Yii::t('app', 'Description'),
            'result_id' => Yii::t('app', 'Result ID'),
            'notes' => Yii::t('app', 'Notes'),
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
     * Gets query for [[Result]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResult()
    {
        return $this->hasOne(MaintenanceResults::class, ['result_id' => 'result_id']);
    }

    /**
     * Gets query for [[Schedule]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedule()
    {
        return $this->hasOne(MaintenanceSchedule::class, ['schedule_id' => 'schedule_id']);
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

}
