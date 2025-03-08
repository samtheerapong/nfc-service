<?php

namespace app\modules\tasks\models;

use Yii;

/**
 * This is the model class for table "team_roles".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $color
 * @property string|null $ref
 */
class TeamRoles extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_roles';
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
            [['name', 'color', 'ref'], 'default', 'value' => null],
            [['name'], 'string', 'max' => 255],
            [['color', 'ref'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'color' => Yii::t('app', 'Color'),
            'ref' => Yii::t('app', 'Ref'),
        ];
    }

}
