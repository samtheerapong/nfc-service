<?php

namespace app\modules\itms\models;

use Yii;

/**
 * This is the model class for table "user_client_auth".
 *
 * @property int $id
 * @property int $profile_id
 * @property string|null $user_login User: PC,DATA,Internet
 * @property string|null $user_login_pass Password: PC,DATA,Internet
 * @property string|null $company_email Email:
 * @property string|null $company_email_pass Password Email:
 * @property string|null $mrp_user_login MRP User:
 * @property string|null $mrp_user_login_pass MRP Password:
 * @property string|null $printer_code Printer Code:
 * @property string|null $phone_number เบอร์โทรภายใน
 * @property string|null $operator_name ผู้ดำเนินการ
 * @property string|null $operator_date วันที่ดำเนินการ
 * @property string|null $operator_comment ความคิดเห็น
 * @property string|null $recorder_date วันที่บันทึก
 * @property string|null $ref_code
 *
 * @property Profile $profile
 */
class UserClientAuth extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_client_auth';
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
            [['user_login', 'user_login_pass', 'company_email', 'company_email_pass', 'mrp_user_login', 'mrp_user_login_pass', 'printer_code', 'phone_number', 'operator_name', 'operator_date', 'operator_comment', 'recorder_date', 'ref_code'], 'default', 'value' => null],
            [['profile_id'], 'required'],
            [['profile_id'], 'integer'],
            [['operator_comment'], 'string'],
            [['user_login', 'user_login_pass', 'company_email_pass', 'mrp_user_login', 'mrp_user_login_pass', 'printer_code', 'phone_number', 'operator_date', 'recorder_date', 'ref_code'], 'string', 'max' => 45],
            [['company_email', 'operator_name'], 'string', 'max' => 200],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_id' => Yii::t('app', 'ผู้ใช้งาน'),
            'user_login' => Yii::t('app', 'User'),
            'user_login_pass' => Yii::t('app', 'Password'),
            'company_email' => Yii::t('app', 'Email:'),
            'company_email_pass' => Yii::t('app', 'Password Email:'),
            'mrp_user_login' => Yii::t('app', 'MRP User:'),
            'mrp_user_login_pass' => Yii::t('app', 'MRP Password:'),
            'printer_code' => Yii::t('app', 'Printer Code:'),
            'phone_number' => Yii::t('app', 'เบอร์โทรภายใน'),
            'operator_name' => Yii::t('app', 'ผู้ดำเนินการ'),
            'operator_date' => Yii::t('app', 'วันที่ดำเนินการ'),
            'operator_comment' => Yii::t('app', 'ความคิดเห็น'),
            'recorder_date' => Yii::t('app', 'วันที่บันทึก'),
            'ref_code' => Yii::t('app', 'Ref Code'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'profile_id']);
    }

    /**
     * Generates a random string for ref_code with a length of 10.
     *
     * @return string
     */
    public function generateRefCode()
    {
        return Yii::$app->security->generateRandomString(10);
    }
}
