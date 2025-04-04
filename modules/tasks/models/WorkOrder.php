<?php

namespace app\modules\tasks\models;

use app\components\HandleUploads;
use app\models\Uploads;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "work_order".
 *
 * @property int $id
 * @property int|null $ticket_id ใบแจ้งซ่อม
 * @property string|null $work_order_code เลขที่ใบสั่งซ่อม
 * @property string|null $work_detail รายละเอียด
 * @property int|null $priority_id ผลกระทบ
 * @property int|null $teamwork ทีมงาน
 * @property string|null $start_date วันที่เริ่มซ่อม
 * @property string|null $end_date วันที่ซ่อมเสร็จ
 * @property string|null $hours จำนวนชั่วโมง
 * @property int|null $work_type_id ประเภทการซ่อม
 * @property string|null $cost ค่าใช้จ่าย
 * @property string|null $approve_name ผู้อนุมัติ
 * @property string|null $approve_date วันที่อนุมัติ
 * @property string|null $approve_comment ความคิดเห็น
 *
 * @property Priority $priority
 * @property Teams $teamwork0
 * @property Ticket $ticket
 * @property WorkType $workType
 */
class WorkOrder extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = 'uploads/works';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_order';
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
            [['ticket_id', 'work_order_code', 'work_detail', 'teamwork', 'start_date', 'end_date', 'hours', 'work_type_id', 'approve_name', 'approve_date', 'approve_comment'], 'default', 'value' => null],
            [['priority_id'], 'default', 'value' => 1],
            [['cost'], 'default', 'value' => 0],
            [['ticket_id', 'priority_id', 'teamwork', 'work_type_id'], 'integer'],
            [['work_detail'], 'string'],
            [['work_order_code', 'start_date', 'end_date', 'hours', 'cost', 'approve_date'], 'string', 'max' => 45],
            [['approve_name', 'approve_comment'], 'string', 'max' => 255],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::class, 'targetAttribute' => ['priority_id' => 'id']],
            [['teamwork'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::class, 'targetAttribute' => ['teamwork' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::class, 'targetAttribute' => ['ticket_id' => 'id']],
            [['work_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkType::class, 'targetAttribute' => ['work_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ticket_id' => Yii::t('app', 'ใบแจ้งซ่อม'),
            'work_order_code' => Yii::t('app', 'เลขที่ใบสั่งซ่อม'),
            'work_detail' => Yii::t('app', 'รายละเอียด'),
            'priority_id' => Yii::t('app', 'ผลกระทบ'),
            'teamwork' => Yii::t('app', 'ทีมงาน'),
            'start_date' => Yii::t('app', 'วันที่เริ่มซ่อม'),
            'end_date' => Yii::t('app', 'วันที่ซ่อมเสร็จ'),
            'hours' => Yii::t('app', 'จำนวนชั่วโมง'),
            'work_type_id' => Yii::t('app', 'ประเภทการซ่อม'),
            'cost' => Yii::t('app', 'ค่าใช้จ่าย'),
            'approve_name' => Yii::t('app', 'ผู้อนุมัติ'),
            'approve_date' => Yii::t('app', 'วันที่อนุมัติ'),
            'approve_comment' => Yii::t('app', 'ความคิดเห็น'),
        ];
    }

    /**
     * Gets query for [[Priority]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::class, ['id' => 'priority_id']);
    }

    /**
     * Gets query for [[Teamwork0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamwork0()
    {
        return $this->hasOne(Teams::class, ['id' => 'teamwork']);
    }

    /**
     * Gets query for [[Ticket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
    }

    /**
     * Gets query for [[WorkType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkType::class, ['id' => 'work_type_id']);
    }


    // use HandleUploads from app\components\HandleUploads
    public function getFirstShowImg()
    {
        return HandleUploads::getFirstShowImg($this->work_order_code, self::UPLOAD_FOLDER);
    }

    public function getShowAllImages()
    {
        return HandleUploads::getFirstShowImg($this->work_order_code, self::UPLOAD_FOLDER);
    }

    public function getShowImages()
    {
        return HandleUploads::getShowImage($this->work_order_code, self::UPLOAD_FOLDER);
    }

    public function getUploads($isAjax = false)
    {
        return HandleUploads::Uploader($this->work_order_code, $isAjax, self::UPLOAD_FOLDER);
    }
 
    public function getUploadedFiles()
    {
        return $this->hasMany(Uploads::class, ['ref' => 'work_order_code']);
    }

    public function getAvatar()
    {
        $imgUrl = HandleUploads::getFirstShowImg($this->work_order_code, self::UPLOAD_FOLDER);
        return   $imgUrl ? Html::img($imgUrl, ['height' => '30px', 'class' => 'img-thumbnail text-center']) : '<span>No Image</span>';
    }
}
