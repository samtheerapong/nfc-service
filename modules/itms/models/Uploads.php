<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property int $upload_id
 * @property string|null $ref
 * @property string|null $file_name ชื่อไฟล์
 * @property string|null $real_filename ชื่อไฟล์จริง
 * @property string|null $create_date
 * @property int|null $type ประเภท
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
        return Yii::$app->get('dbit');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref', 'file_name', 'real_filename', 'type'], 'default', 'value' => null],
            [['create_date'], 'safe'],
            [['type'], 'integer'],
            [['ref'], 'string', 'max' => 50],
            [['file_name', 'real_filename'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => Yii::t('app', 'Upload ID'),
            'ref' => Yii::t('app', 'Ref'),
            'file_name' => Yii::t('app', 'ชื่อไฟล์'),
            'real_filename' => Yii::t('app', 'ชื่อไฟล์จริง'),
            'create_date' => Yii::t('app', 'Create Date'),
            'type' => Yii::t('app', 'ประเภท'),
        ];
    }

}
