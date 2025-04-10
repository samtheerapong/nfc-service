<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $color
 * @property string|null $category
 *
 * @property Accessories[] $accessories
 * @property Computers[] $computers
 * @property Monitors[] $monitors
 * @property Printers[] $printers
 * @property Profile[] $profiles
 * @property Software[] $softwares
 */
class Status extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
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
            [['name', 'color', 'category'], 'default', 'value' => null],
            [['name', 'color'], 'string', 'max' => 45],
            [['category'], 'string', 'max' => 100],
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
            'category' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * Gets query for [[Accessories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccessories()
    {
        return $this->hasMany(Accessories::class, ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Computers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputers()
    {
        return $this->hasMany(Computers::class, ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Monitors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMonitors()
    {
        return $this->hasMany(Monitors::class, ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Printers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrinters()
    {
        return $this->hasMany(Printers::class, ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['status_id' => 'id']);
    }

    /**
     * Gets query for [[Softwares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoftwares()
    {
        return $this->hasMany(Software::class, ['status_id' => 'id']);
    }

}
