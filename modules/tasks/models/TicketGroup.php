<?php

namespace app\modules\tasks\models;

use Yii;
 
class TicketGroup extends \yii\db\ActiveRecord
{
 
    public static function tableName()
    {
        return 'ticket_group';
    }
 
    public static function getDb()
    {
        return Yii::$app->get('engineer');
    }
 
    public function rules()
    {
        return [
            [['name', 'color'], 'default', 'value' => null],
            [['name', 'color'], 'string', 'max' => 45],
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'color' => Yii::t('app', 'Color'),
        ];
    }

}
