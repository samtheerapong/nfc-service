<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "task_actions".
 *
 * @property int $id
 * @property string $task_code
 * @property string|null $action_code
 * @property string|null $process_fixed วิธีการแก้ไข
 * @property string|null $comment ความคิดเห็นเพิ่มเติม
 * @property string|null $start_date วันเริ่ม
 * @property string|null $end_date วันเสร็จ
 * @property string|null $operator ผู้ดำเนินการ
 * @property string|null $item อุปกรณ์
 * @property int|null $cost ค่าใช้จ่าย
 */
class TaskActions extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'task_actions';
    }

    public static function getDb()
    {
        return Yii::$app->get('dbit');
    }

    public function rules()
    {
        return [
            [['task_code',  'start_date', 'end_date', 'operator'], 'required'],
            [['action_code', 'process_fixed', 'comment', 'start_date', 'end_date', 'operator', 'item'], 'default', 'value' => null],
            [['cost'], 'default', 'value' => 0],
            [['task_code'], 'required'],
            [['process_fixed', 'comment'], 'string'],
            [['cost'], 'integer'],
            [['task_code', 'action_code', 'start_date', 'end_date'], 'string', 'max' => 45],
            [['operator'], 'string', 'max' => 100],
            [['item'], 'string', 'max' => 255],
            [['action_code'], 'unique'],
            [['task_code'], 'unique', 'message' => Yii::t('app', '"{value}" ได้ดำเนินการไปแล้ว')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_code' => Yii::t('app', 'รหัสการแจ้งงาน'),
            'action_code' => Yii::t('app', 'รหัส'),
            'process_fixed' => Yii::t('app', 'วิธีการแก้ไข'),
            'comment' => Yii::t('app', 'ความคิดเห็นเพิ่มเติม'),
            'start_date' => Yii::t('app', 'วันเริ่ม'),
            'end_date' => Yii::t('app', 'วันเสร็จ'),
            'operator' => Yii::t('app', 'ผู้ดำเนินการ'),
            'item' => Yii::t('app', 'อุปกรณ์'),
            'cost' => Yii::t('app', 'ค่าใช้จ่าย'),
        ];
    }
}
