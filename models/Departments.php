<?php

namespace app\models;
 
use Yii;

class Departments extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'departments';
    }

    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    public function rules()
    {
        return [
            [['code', 'name', 'color'], 'required'],
            [['manager_id', 'approve_id', 'flow_id'], 'integer'],
            [['code', 'color'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'รหัส'),
            'name' => Yii::t('app', 'ชื่อแผนก'),
            'manager_id' => Yii::t('app', 'อนุมัติภายใน'),
            'approve_id' => Yii::t('app', 'ผู้อนุมัติสูงสุด'),
            'flow_id' => Yii::t('app', 'สายงานบริหาร'),
            'color' => Yii::t('app', 'สี'),
        ];
    }
    
}
