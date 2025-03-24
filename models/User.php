<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    // status
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 9;
    const STATUS_DELETED = 0;

    const ACTIVED = 1;
    const INACTIVE = 0;

    public $confirm_password;


    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            // ['employee_id', 'unique', 'message' => Yii::t('app', 'Already used')],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['department_id', 'default', 'value' => 1],
            ['role_id', 'default', 'value' => 1],
            ['rule_id', 'default', 'value' => 1],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['thai_name', 'email'], 'string'],
            [['username', 'password_hash', 'email', 'thai_name'], 'required'],
            [['department_id', 'role_id', 'rule_id', 'employee_id'], 'safe'],
            // [['confirm_password'], 'compare', 'compareAttribute' => 'password_hash', 'message' => Yii::t('app', 'Passwords must match.')],
            // [['password_hash', 'repeat_password'], 'required', 'on' => ['create', 'update']],
            // [['password_hash', 'repeat_password'], 'string', 'min' => 3],
            // ['repeat_password', 'compare', 'compareAttribute' => 'password_hash', 'message' => Yii::t('app', "Passwords don't match")],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'USERNAME'),
            'thai_name' => Yii::t('app', 'ชื่อ-สกุล'),
            'password_hash' => Yii::t('app', 'รหัสผ่าน'),
            'status' => Yii::t('app', 'สถานะ'),
            'email' => Yii::t('app', 'อีเมล'),
            'role_id' => Yii::t('app', 'Role'),
            'rule_id' => Yii::t('app', 'Rule'),
            'department_id' => Yii::t('app', 'แผนก'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'updated_at' => Yii::t('app', 'ปรับปรุงเมื่อ'),
            'employee_id' => Yii::t('app', 'ชื่อพนักงาน'),
            'confirm_password' => Yii::t('app', 'ใส่รหัสผ่านอีกครั้ง'),
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getDepartment()
    {
        return $this->hasOne(Departments::class, ['id' => 'department_id']);
    }
}
