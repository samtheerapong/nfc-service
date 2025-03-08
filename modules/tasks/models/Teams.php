<?php

namespace app\modules\tasks\models;

use Yii;
use app\models\Users;

class Teams extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'teams';
    }

    public static function getDb()
    {
        return Yii::$app->get('engineer');
    }

    public function rules()
    {
        return [
            [['name', 'team_header', 'team_role', 'team_email', 'api'], 'default', 'value' => null],
            [['active'], 'default', 'value' => 1],
            [['team_header', 'team_role', 'active'], 'integer'],
            [['name', 'team_email', 'api'], 'string', 'max' => 255],
            // Ensure team_header exists in the Users table.
            [['team_header'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['team_header' => 'id']],
            // Ensure team_role exists in the TeamRoles table.
            [['team_role'], 'exist', 'skipOnError' => true, 'targetClass' => TeamRoles::class, 'targetAttribute' => ['team_role' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'team_header' => Yii::t('app', 'Team Header'),
            'team_role' => Yii::t('app', 'Team Role'),
            'team_email' => Yii::t('app', 'Team Email'),
            'api' => Yii::t('app', 'Api'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * Gets query for [[TeamHeader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamHeader()
    {
        return $this->hasOne(Users::class, ['id' => 'team_header']);
    }

    /**
     * Gets query for [[TeamRole]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamRole()
    {
        return $this->hasOne(TeamRoles::class, ['id' => 'team_role']);
    }
}
