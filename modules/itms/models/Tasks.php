<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string|null $ref_code รหัสงาน
 * @property string $title หัวข้อ
 * @property string|null $description รายละเอียด
 * @property string|null $task_date วันที่แจ้ง
 * @property int $type_id ประเภท
 * @property int $department_id หน่วยงานที่แจ้ง
 * @property string|null $user_request ผู้แจ้ง
 * @property int $status_id สถานะ
 * @property string|null $remask หมายเหตุ
 * @property int|null $task_year #ปี
 * @property int|null $task_month #เดือน
 *
 * @property TaskDepartments $taskDepartments
 * @property TaskStatus $taskStatus
 * @property TaskTypes $taskTypes
 */
class Tasks extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbit');
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Gets query for [[TaskDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskDepartments()
    {
        return $this->hasOne(TaskDepartments::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[TaskStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[TaskTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskTypes()
    {
        return $this->hasOne(TaskTypes::class, ['id' => 'type_id']);
    }
}
