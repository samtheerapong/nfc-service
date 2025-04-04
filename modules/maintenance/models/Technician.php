<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "technician".
 *
 * @property int $technician_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $position
 *
 * @property MaintenanceLog[] $maintenanceLogs
 * @property MaintenanceSchedule[] $maintenanceSchedules
 */
class Technician extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'technician';
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
            [['email', 'phone', 'position'], 'default', 'value' => null],
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name', 'position'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'technician_id' => Yii::t('app', 'Technician ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    /**
     * Gets query for [[MaintenanceLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, ['technician_id' => 'technician_id']);
    }

    /**
     * Gets query for [[MaintenanceSchedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, ['technician_id' => 'technician_id']);
    }

}
