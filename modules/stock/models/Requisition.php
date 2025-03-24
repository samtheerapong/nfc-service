<?php

namespace app\modules\stock\models;

use Yii;
 
class Requisition extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'requisition';
    }
 
    public static function getDb()
    {
        return Yii::$app->get('dbstock');
    }
 
    public function rules()
    {
        return [
            [['approved_by', 'approved_at'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['equipment_id', 'user_name', 'quantity'], 'required'],
            [['equipment_id', 'quantity'], 'integer'],
            [['status_id'], 'safe'],
            [['created_at', 'approved_at'], 'safe'],
            [['user_name', 'approved_by'], 'string', 'max' => 100], 
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::class, 'targetAttribute' => ['equipment_id' => 'id']],
            // [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequisitionStatus::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'equipment_id' => Yii::t('app', 'Equipment ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'quantity' => Yii::t('app', 'Quantity'),
            'status_id' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'approved_by' => Yii::t('app', 'Approved By'),
            'approved_at' => Yii::t('app', 'Approved At'),
        ];
    }
 
    public function getEquipment()
    {
        return $this->hasOne(Equipment::class, ['id' => 'equipment_id']);
    }
 
    public function getStatus()
    {
        return $this->hasOne(RequisitionStatus::class, ['id' => 'status_id']);
    }

    public static function optsStatus()
    {
        return \yii\helpers\ArrayHelper::map(
            RequisitionStatus::find()->where(['is_active' => 1])->all(),
            'id',
            'name'
        );
    }
 
    public function displayStatus()
    {
        return $this->status ? $this->status->name : '-';
    }

    public function isStatusPending()
    {
        return $this->status_id == RequisitionStatus::findOne(['code' => 'pending'])->id;
    }

    public function setStatusToPending()
    {
        $this->status_id = RequisitionStatus::findOne(['code' => 'pending'])->id;
    }

    public function isStatusApproved()
    {
        return $this->status_id == RequisitionStatus::findOne(['code' => 'approved'])->id;
    }

    public function setStatusToApproved()
    {
        $this->status_id = RequisitionStatus::findOne(['code' => 'approved'])->id;
    }

    public function isStatusRejected()
    {
        return $this->status_id == RequisitionStatus::findOne(['code' => 'rejected'])->id;
    }

    public function setStatusToRejected()
    {
        $this->status_id = RequisitionStatus::findOne(['code' => 'rejected'])->id;
    }

    public function isStatusCancel()
    {
        return $this->status_id == RequisitionStatus::findOne(['code' => 'cancel'])->id;
    }

    public function setStatusToCancel()
    {
        $this->status_id = RequisitionStatus::findOne(['code' => 'cancel'])->id;
    }
}
