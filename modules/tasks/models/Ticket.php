<?php

namespace app\modules\tasks\models;

use app\components\HandleUploads;
use app\models\Uploads;
use Yii;
use yii\helpers\Html;

class Ticket extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = 'uploads/ticket';

    public static function tableName()
    {
        return 'ticket';
    }

    public static function getDb()
    {
        return Yii::$app->get('engineer');
    }

    public function rules()
    {
        return [
            [['ticket_group', 'ticket_date', 'request_by', 'title', 'location'], 'required'],
            [['ticket_code', 'ticket_date', 'title', 'description', 'remask', 'request_by', 'created_at', 'approve_name', 'approve_date', 'approve_comment'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['ticket_group', 'status_id'], 'integer'],
            [['description', 'approve_comment'], 'string'],
            [['ticket_code', 'ticket_date', 'created_at', 'approve_date', 'location'], 'string', 'max' => 45],
            [['title', 'remask', 'request_by', 'approve_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ticket_group' => Yii::t('app', 'กลุ่มงาน'),
            'ticket_code' => Yii::t('app', 'รหัส'),
            'ticket_date' => Yii::t('app', 'วันที่ต้องการ'),
            'title' => Yii::t('app', 'หัวข้อ'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'location' => Yii::t('app', 'สถานที่'),
            'remask' => Yii::t('app', 'หมายเหตุ'),
            'request_by' => Yii::t('app', 'ผู้ร้องขอ'),
            'created_at' => Yii::t('app', 'วันที่บันทึก'),
            'approve_name' => Yii::t('app', 'ผู้อนุมัติ'),
            'approve_date' => Yii::t('app', 'วันที่อนุมัติ'),
            'approve_comment' => Yii::t('app', 'ความคิดเห็นผู้อนุมัติ'),
            'status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    public function formatStatus()
    {
        return $this->status_id ? '<span class="badge" style="background-color:' . $this->status->color . '">' . $this->status->name . '</span>' : '';
    }

    public function getGroup()
    {
        return $this->hasOne(TicketGroup::class, ['id' => 'ticket_group']);
    }

    public function getLocation0()
    {
        return $this->hasOne(location::class, ['name' => 'location']);
    }

    // use HandleUploads from app\components\HandleUploads
    public function getFirstShowImg()
    {
        return HandleUploads::getFirstShowImg($this->ticket_code, self::UPLOAD_FOLDER);
    }

    public function getShowAllImages()
    {
        return HandleUploads::getFirstShowImg($this->ticket_code, self::UPLOAD_FOLDER);
    }

    public function getShowImages()
    {
        return HandleUploads::getShowImage($this->ticket_code, self::UPLOAD_FOLDER);
    }

    public function getUploads($isAjax = false)
    {
        return HandleUploads::Uploader($this->ticket_code, $isAjax, self::UPLOAD_FOLDER);
    }


    public function getUploadedFiles()
    {
        return $this->hasMany(Uploads::class, ['ref' => 'ticket_code']);
    }

    public function getAvatar()
    {
        $imgUrl = HandleUploads::getFirstShowImg($this->ticket_code, self::UPLOAD_FOLDER);
        return   $imgUrl ? Html::img($imgUrl, ['height' => '30px', 'class' => 'img-thumbnail text-center']) : '<span>No Image</span>';
    }
}
