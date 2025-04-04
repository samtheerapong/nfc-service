<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "schedule_statuses".
 *
 * @property int $status_id
 * @property string $status_name
 *
 * @property MaintenanceSchedule[] $maintenanceSchedules
 */
class ScheduleStatuses extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule_statuses';
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
            [['status_name'], 'required'],
            [['status_name'], 'string', 'max' => 50],
            [['status_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_id' => Yii::t('app', 'Status ID'),
            'status_name' => Yii::t('app', 'Status Name'),
        ];
    }

    /**
     * Gets query for [[MaintenanceSchedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, ['status_id' => 'status_id']);
    }

}
