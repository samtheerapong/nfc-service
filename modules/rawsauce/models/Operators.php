<?php

namespace app\modules\rawsauce\models;

use Yii;

/**
 * This is the model class for table "operators".
 *
 * @property int $id
 * @property int|null $user_id ผู้ใช้ในระบบ
 * @property string|null $name ชื่อ-สกุล
 * @property int|null $user_group กลุ่มผู้ใช้
 * @property int|null $department แผนก
 * @property int|null $status_id สถานะ
 */
class Operators extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operators';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('rawsauce');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'department'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['user_id', 'user_group', 'department', 'status_id'], 'integer'],
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
            'user_id' => Yii::t('app', 'ผู้ใช้ในระบบ'),
            'name' => Yii::t('app', 'ชื่อ-สกุล'),
            'user_group' => Yii::t('app', 'กลุ่มผู้ใช้'),
            'department' => Yii::t('app', 'แผนก'),
            'status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

}
