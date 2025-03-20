<?php

namespace app\modules\tasks\models;

use Yii;
 
class TicketList extends \yii\db\ActiveRecord
{
 
    public static function tableName()
    {
        return 'ticket_list';
    }
 
    public static function getDb()
    {
        return Yii::$app->get('engineer');
    }
 
    public function rules()
    {
        return [
            [['remask', 'ticket_date'], 'default', 'value' => null],
            [['quantity'], 'default', 'value' => 1],
            [['ticket_code', 'details', 'location'], 'required'],
            [['location', 'quantity'], 'integer'],
            [['ticket_code', 'ticket_date'], 'string', 'max' => 45],
            [['details', 'remask'], 'string', 'max' => 255],
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ticket_code' => Yii::t('app', 'Ticket Code'),
            'details' => Yii::t('app', 'Details'),
            'remask' => Yii::t('app', 'Remask'),
            'location' => Yii::t('app', 'Location'),
            'ticket_date' => Yii::t('app', 'Ticket Date'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }

}
