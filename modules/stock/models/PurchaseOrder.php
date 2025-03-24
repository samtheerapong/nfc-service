<?php

namespace app\modules\stock\models;

use Yii;

/**
 * This is the model class for table "purchase_order".
 *
 * @property int $id
 * @property int $equipment_id
 * @property int $quantity
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $ordered_at
 * @property string|null $received_at
 *
 * @property Equipment $equipment
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_PENDING = 'pending';
    const STATUS_ORDERED = 'ordered';
    const STATUS_RECEIVED = 'received';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_order';
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
            [['ordered_at', 'received_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'pending'],
            [['equipment_id', 'quantity'], 'required'],
            [['equipment_id', 'quantity'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'ordered_at', 'received_at'], 'safe'],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
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
            'quantity' => Yii::t('app', 'Quantity'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'ordered_at' => Yii::t('app', 'Ordered At'),
            'received_at' => Yii::t('app', 'Received At'),
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


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_PENDING => Yii::t('app', 'pending'),
            self::STATUS_ORDERED => Yii::t('app', 'ordered'),
            self::STATUS_RECEIVED => Yii::t('app', 'received'),
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function setStatusToPending()
    {
        $this->status = self::STATUS_PENDING;
    }

    /**
     * @return bool
     */
    public function isStatusOrdered()
    {
        return $this->status === self::STATUS_ORDERED;
    }

    public function setStatusToOrdered()
    {
        $this->status = self::STATUS_ORDERED;
    }

    /**
     * @return bool
     */
    public function isStatusReceived()
    {
        return $this->status === self::STATUS_RECEIVED;
    }

    public function setStatusToReceived()
    {
        $this->status = self::STATUS_RECEIVED;
    }
}
