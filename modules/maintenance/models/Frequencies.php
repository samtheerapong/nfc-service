<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "frequencies".
 *
 * @property int $frequency_id
 * @property string $frequency_name
 *
 * @property MaintenanceSchedule[] $maintenanceSchedules
 */
class Frequencies extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frequencies';
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
            [['frequency_name'], 'required'],
            [['frequency_name'], 'string', 'max' => 50],
            [['frequency_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'frequency_id' => Yii::t('app', 'Frequency ID'),
            'frequency_name' => Yii::t('app', 'Frequency Name'),
        ];
    }

    /**
     * Gets query for [[MaintenanceSchedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class, ['frequency_id' => 'frequency_id']);
    }

}
