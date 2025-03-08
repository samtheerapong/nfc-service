<?php

namespace app\modules\itms\models;

use app\components\HandleUploads;
use Yii;
use yii\helpers\Html;

class Tasks extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = 'uploads/it';

    public static function tableName()
    {
        return 'tasks';
    }

    public static function getDb()
    {
        return Yii::$app->get('dbit');
    }

    public function rules()
    {
        return [
            [['ref_code', 'description', 'task_date', 'user_request', 'remask', 'task_year', 'task_month'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['title', 'type_id', 'department_id', 'status_id'], 'required'],
            [['description'], 'string'],
            [['type_id', 'department_id', 'status_id', 'task_year', 'task_month'], 'integer'],
            [['ref_code', 'task_date'], 'string', 'max' => 45],
            [['title', 'user_request', 'remask'], 'string', 'max' => 255],
            [['ref_code'], 'unique'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskDepartments::class, 'targetAttribute' => ['department_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskTypes::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref_code' => Yii::t('app', 'รหัสงาน'),
            'title' => Yii::t('app', 'หัวข้อ'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'task_date' => Yii::t('app', 'วันที่แจ้ง'),
            'type_id' => Yii::t('app', 'ประเภท'),
            'department_id' => Yii::t('app', 'หน่วยงานที่แจ้ง'),
            'user_request' => Yii::t('app', 'ผู้แจ้ง'),
            'status_id' => Yii::t('app', 'สถานะ'),
            'remask' => Yii::t('app', 'หมายเหตุ'),
            'task_year' => Yii::t('app', '#ปี'),
            'task_month' => Yii::t('app', '#เดือน'),
        ];
    }

    public function getTaskDepartments()
    {
        return $this->hasOne(TaskDepartments::class, ['id' => 'department_id']);
    }


    public function getTaskStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    public function getTaskTypes()
    {
        return $this->hasOne(TaskTypes::class, ['id' => 'type_id']);
    }

    public function getAvatar()
    {
        $imgUrl = HandleUploads::getFirstShowImg($this->ref_code, self::UPLOAD_FOLDER);
        return   $imgUrl ? Html::img($imgUrl, ['height' => '30px', 'class' => 'img-thumbnail text-center']) : '<span>No Image</span>';
    }
}
