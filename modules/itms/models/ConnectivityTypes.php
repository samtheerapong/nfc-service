<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "connectivity_types".
 *
 * @property int $id
 * @property string $name
 * @property string|null $category
 *
 * @property Monitors[] $monitors
 * @property Printers[] $printers
 */
class ConnectivityTypes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'connectivity_types';
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
            [['category'], 'default', 'value' => null],
            [['name'], 'required'],
            [['name', 'category'], 'string', 'max' => 100],
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
            'category' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * Gets query for [[Monitors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMonitors()
    {
        return $this->hasMany(Monitors::class, ['connectivity_types_id' => 'id']);
    }

    /**
     * Gets query for [[Printers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrinters()
    {
        return $this->hasMany(Printers::class, ['connectivity_types_id' => 'id']);
    }

}
