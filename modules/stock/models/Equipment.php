<?php

namespace app\modules\stock\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "equipment".
 *
 * @property int $id
 * @property string $name
 * @property int $stock
 * @property int|null $low_stock_level
 * @property string|null $created_at
 *
 * @property PurchaseOrder[] $purchaseOrders
 * @property Requisition[] $requisitions
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
        return Yii::$app->get('dbstock');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock'], 'default', 'value' => 0],
            [['low_stock_level'], 'default', 'value' => 10],
            [['name'], 'required'],
            [['stock', 'low_stock_level'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'stock' => Yii::t('app', 'Stock'),
            'low_stock_level' => Yii::t('app', 'Low Stock Level'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[PurchaseOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class, ['equipment_id' => 'id']);
    }

    /**
     * Gets query for [[Requisitions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequisitions()
    {
        return $this->hasMany(Requisition::class, ['equipment_id' => 'id']);
    }
 
}
