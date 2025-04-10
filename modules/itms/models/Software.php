<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "software".
 *
 * @property int $id
 * @property int $software_id Software
 * @property int $computer_id Computer
 * @property string|null $asset_code รหัสสินทรัพย์
 * @property string $software_name ชื่อ
 * @property string|null $description รายละเอียด
 * @property string $version Version
 * @property string|null $license_key License Key
 * @property string|null $installation_date วันที่ติดตั้งล่าสุด
 * @property string|null $expiry_date วันที่หมดอายุ
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $ref_code
 * @property int|null $status_id สถานะ
 *
 * @property Computers $computer
 * @property Status $status
 */
class Software extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'software';
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
            [['asset_code', 'description', 'license_key', 'installation_date', 'expiry_date', 'created_at', 'updated_at', 'ref_code'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['software_id', 'computer_id', 'software_name', 'version'], 'required'],
            [['software_id', 'computer_id', 'status_id'], 'integer'],
            [['description'], 'string'],
            [['installation_date', 'expiry_date'], 'safe'],
            [['asset_code', 'version', 'created_at', 'updated_at', 'ref_code'], 'string', 'max' => 45],
            [['software_name', 'license_key'], 'string', 'max' => 100],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['computer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Computers::class, 'targetAttribute' => ['computer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'software_id' => Yii::t('app', 'Software'),
            'computer_id' => Yii::t('app', 'Computer'),
            'asset_code' => Yii::t('app', 'รหัสสินทรัพย์'),
            'software_name' => Yii::t('app', 'ชื่อ'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'version' => Yii::t('app', 'Version'),
            'license_key' => Yii::t('app', 'License Key'),
            'installation_date' => Yii::t('app', 'วันที่ติดตั้งล่าสุด'),
            'expiry_date' => Yii::t('app', 'วันที่หมดอายุ'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ref_code' => Yii::t('app', 'Ref Code'),
            'status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Computer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputer()
    {
        return $this->hasOne(Computers::class, ['id' => 'computer_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

}
