<?php

namespace app\modules\tasks\models;

use app\components\HandleUploads;
use app\models\Uploads;
use app\models\Users;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class Technician extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = 'uploads/technician';

    const STATUS_ACTIVE = 'yes';
    const STATUS_INACTIVE = 'no';

    public static function tableName()
    {
        return 'technician';
    }

    public static function getDb()
    {
        return Yii::$app->get('engineer');
    }

    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'required'],
            [['ref', 'user_id', 'tel', 'email', 'api'], 'default', 'value' => null],
            [['user_id', 'role_id'], 'integer'],
            [['ref', 'tel'], 'string', 'max' => 45],
            [['thainame', 'email', 'api'], 'string', 'max' => 255],
            [['ref'], 'unique'],
            [['user_id'], 'unique'],
            [['active'], 'string'],
            [['active'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
            [['active'], 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref' => Yii::t('app', 'รหัสพนักงาน'),
            'user_id' => Yii::t('app', 'ผู้ใช้งานในระบบ'),
            'thainame' => Yii::t('app', 'ชื่อ-สกุล'),
            'role_id' => Yii::t('app', 'บทบาท'),
            'tel' => Yii::t('app', 'เบอร์โทร'),
            'email' => Yii::t('app', 'อีเมล'),
            'api' => Yii::t('app', 'Api'),
            'active' => Yii::t('app', 'ใช้งาน'),
        ];
    }

    public static function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Yes'),
            self::STATUS_INACTIVE => Yii::t('app', 'No'),
        ];
    }

    // Get status label
    public function getStatusLabel()
    {
        $options = self::getStatusOptions();
        return $options[$this->active] ?? $this->active;
    }

    public function getUploadedFiles()
    {
        return $this->hasMany(Uploads::class, ['ref' => 'ref']);
    }

    public function getUsers()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    public function getRoles()
    {
        return $this->hasOne(TeamRoles::class, ['id' => 'role_id']);
    }

    // use HandleUploads from app\components\HandleUploads
    public function getFirstShowImg()
    {
        return HandleUploads::getFirstShowImg($this->ref, self::UPLOAD_FOLDER);
    }

    public function getShowAllImages()
    {
        return HandleUploads::getFirstShowImg($this->ref, self::UPLOAD_FOLDER);
    }

    public function getShowImages()
    {
        return HandleUploads::getShowImage($this->ref, self::UPLOAD_FOLDER);
    }

    public function getUploads($isAjax = false)
    {
        return HandleUploads::Uploader($this->ref, $isAjax, self::UPLOAD_FOLDER);
    }

    public function getAvatar()
    {
        $imgUrl = HandleUploads::getFirstShowImg($this->ref, self::UPLOAD_FOLDER);
        return   $imgUrl ? Html::img($imgUrl, ['height' => '30px', 'class' => 'img-thumbnail text-center']) : '<span>No Image</span>';
    }

    // Options
    public function formatPhoneNumber($phoneNumber)
    {
        // ลบอักขระที่ไม่ใช่ตัวเลขออก
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // ตรวจสอบความยาวของเบอร์โทรศัพท์
        if (strlen($phoneNumber) === 10) {
            return substr($phoneNumber, 0, 3) . '-' . substr($phoneNumber, 3, 3) . '-' . substr($phoneNumber, 6);
        }

        // หากไม่ตรงกับรูปแบบที่คาดหวัง ให้คืนค่าเดิม
        return $phoneNumber;
    }
}
