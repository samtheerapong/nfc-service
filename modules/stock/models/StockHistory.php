<?php

namespace app\modules\stock\models;

use Yii;

/**
 * This is the model class for table "stock_history".
 *
 * @property int $id
 * @property int $equipment_id
 * @property int $quantity_change
 * @property string|null $reason
 * @property string|null $updated_by
 * @property string|null $updated_at
 *
 * @property Equipment $equipment
 */
class StockHistory extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_history';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbstock');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reason', 'updated_by'], 'default', 'value' => null],
            [['equipment_id', 'quantity_change'], 'required'],
            [['equipment_id', 'quantity_change'], 'integer'],
            [['updated_at'], 'safe'],
            [['reason'], 'string', 'max' => 255],
            [['updated_by'], 'string', 'max' => 100],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::class, 'targetAttribute' => ['equipment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'quantity_change' => Yii::t('app', 'Quantity Change'),
            'reason' => Yii::t('app', 'Reason'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Equipment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipment::class, ['id' => 'equipment_id']);
    }

}
