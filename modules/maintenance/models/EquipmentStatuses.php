<?php

namespace app\modules\maintenance\models;

use Yii;

/**
 * This is the model class for table "equipment_statuses".
 *
 * @property int $status_id
 * @property string $status_name
 *
 * @property Equipment[] $equipments
 */
class EquipmentStatuses extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipment_statuses';
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
     * Gets query for [[Equipments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(Equipment::class, ['status_id' => 'status_id']);
    }

}
