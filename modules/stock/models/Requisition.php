<?php

namespace app\modules\stock\models;

use Yii;

/**
 * This is the model class for table "requisition".
 *
 * @property int $id
 * @property int $equipment_id
 * @property string $user_name
 * @property int $quantity
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $approved_by
 * @property string|null $approved_at
 *
 * @property Equipment $equipment
 */
class Requisition extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisition';
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
            [['approved_by', 'approved_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'pending'],
            [['equipment_id', 'user_name', 'quantity'], 'required'],
            [['equipment_id', 'quantity'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'approved_at'], 'safe'],
            [['user_name', 'approved_by'], 'string', 'max' => 100],
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
            'user_name' => Yii::t('app', 'User Name'),
            'quantity' => Yii::t('app', 'Quantity'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'approved_by' => Yii::t('app', 'Approved By'),
            'approved_at' => Yii::t('app', 'Approved At'),
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
            self::STATUS_APPROVED => Yii::t('app', 'approved'),
            self::STATUS_REJECTED => Yii::t('app', 'rejected'),
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
    public function isStatusApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function setStatusToApproved()
    {
        $this->status = self::STATUS_APPROVED;
    }

    /**
     * @return bool
     */
    public function isStatusRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function setStatusToRejected()
    {
        $this->status = self::STATUS_REJECTED;
    }
}
