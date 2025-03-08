<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "task_departments".
 *
 * @property int $id
 * @property string|null $code
 * @property string $name
 * @property string $color
 *
 * @property Tasks[] $tasks
 */
class TaskDepartments extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_departments';
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
            [['code'], 'default', 'value' => null],
            [['color'], 'default', 'value' => '#666666'],
            [['name'], 'required'],
            [['code', 'color'], 'string', 'max' => 45],
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
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['department_id' => 'id']);
    }

}
