<?php

namespace app\modules\tasks\models;

use Yii;
 
class Location extends \yii\db\ActiveRecord
{
 
    public static function tableName()
    {
        return 'location';
    }
 
    public static function getDb()
    {
        return Yii::$app->get('engineer');
    }
 
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
 
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'รหัส'),
            'name' => Yii::t('app', 'ชื่อ'),
            'detail' => Yii::t('app', 'รายละเอียด'),
            'color' => Yii::t('app', 'สี'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

}
