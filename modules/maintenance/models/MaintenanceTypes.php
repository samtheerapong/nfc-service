<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "maintenance_types".
 *
 * @property int $type_id
 * @property string $type_name
 *
 * @property MaintenanceSchedule[] $maintenanceSchedules
 */
class MaintenanceTypes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenance_types';
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
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 50],
            [['type_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type_id' => Yii::t('app', 'Type ID'),
            'type_name' => Yii::t('app', 'Type Name'),
        ];
    }

    /**
     * Gets query for [[MaintenanceSchedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, ['type_id' => 'type_id']);
    }

}
