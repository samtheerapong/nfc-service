<?php

namespace app\modules\ticket\models;

use Yii;

/**
 * This is the model class for table "ticket_list".
 *
 * @property int $id
 * @property string $ticket_code
 * @property string $details
 * @property string|null $remask
 * @property int $location
 * @property string|null $ticket_date
 * @property int|null $quantity
 */
class TicketList extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_list';
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
            [['remask', 'ticket_date'], 'default', 'value' => null],
            [['quantity'], 'default', 'value' => 1],
            [['ticket_code', 'details', 'location'], 'required'],
            [['location', 'quantity'], 'integer'],
            [['ticket_code', 'ticket_date'], 'string', 'max' => 45],
            [['details', 'remask'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
