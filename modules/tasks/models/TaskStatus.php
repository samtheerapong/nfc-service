<?php

namespace app\modules\tasks\models;

use Yii;

/**
 * This is the model class for table "task_status".
 *
 * @property int $id
 * @property string $code รหัส
 * @property string $name สถานะ
 * @property string|null $detail รายละเอียด
 * @property string|null $color สี
 * @property int|null $active สถานะ
 */
class TaskStatus extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_status';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('engineer');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail', 'color'], 'default', 'value' => null],
            [['active'], 'default', 'value' => 1],
            [['code', 'name'], 'required'],
            [['detail'], 'string'],
            [['active'], 'integer'],
            [['code', 'name', 'color'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'รหัส'),
            'name' => Yii::t('app', 'สถานะ'),
            'detail' => Yii::t('app', 'รายละเอียด'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

}
