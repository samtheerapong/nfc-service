<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $file_name
 * @property string|null $real_filename
 * @property string|null $last_updated
 */
class Uploads extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads';
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
            [['ref', 'file_name', 'real_filename'], 'default', 'value' => null],
            [['last_updated'], 'safe'],
            [['ref', 'file_name', 'real_filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref' => Yii::t('app', 'Ref'),
            'file_name' => Yii::t('app', 'File Name'),
            'real_filename' => Yii::t('app', 'Real Filename'),
            'last_updated' => Yii::t('app', 'Last Updated'),
        ];
    }

}
