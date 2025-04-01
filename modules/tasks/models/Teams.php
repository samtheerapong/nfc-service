<?php

namespace app\modules\tasks\models;

use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property int $id
 * @property string|null $name ชื่อทีม
 * @property int|null $team_header หัวหน้าทีม
 * @property int|null $team_role บทบาท
 * @property string|null $team_user
 * @property string|null $team_email อีเมลทีม
 * @property string|null $api API
 * @property int|null $active สถานะ
 *
 * @property WorkOrder[] $workOrders
 */
class Teams extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teams';
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
            [['name', 'team_header', 'team_role', 'team_user', 'team_email', 'api'], 'default', 'value' => null],
            [['active'], 'default', 'value' => 1],
            [['team_header', 'team_role', 'active'], 'integer'],
            [['team_user'], 'string'],
            [['name', 'team_email', 'api'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชื่อทีม'),
            'team_header' => Yii::t('app', 'หัวหน้าทีม'),
            'team_role' => Yii::t('app', 'บทบาท'),
            'team_user' => Yii::t('app', 'Team User'),
            'team_email' => Yii::t('app', 'อีเมลทีม'),
            'api' => Yii::t('app', 'API'),
            'active' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[WorkOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrders()
    {
        return $this->hasMany(WorkOrder::class, ['teamwork' => 'id']);
    }

}
