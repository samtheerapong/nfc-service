<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "maintenance_results".
 *
 * @property int $result_id
 * @property string $result_name
 *
 * @property MaintenanceLog[] $maintenanceLogs
 */
class MaintenanceResults extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenance_results';
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
            [['result_name'], 'required'],
            [['result_name'], 'string', 'max' => 50],
            [['result_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'result_id' => Yii::t('app', 'Result ID'),
            'result_name' => Yii::t('app', 'Result Name'),
        ];
    }

    /**
     * Gets query for [[MaintenanceLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, ['result_id' => 'result_id']);
    }

}
