<?php

namespace app\modules\itms\models;

use app\models\Departments;
use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int|null $user_id รหัสพนักงาน
 * @property int|null $title_name คำนำหน้าชื่อ
 * @property string|null $thai_name ชื่อ-สกุล
 * @property string|null $english_name English Name
 * @property string|null $nickname ชื่อเล่น
 * @property string|null $date_of_birth วันเกิด
 * @property string|null $start_date วันเริ่มงาน
 * @property string|null $position ตำแหน่ง
 * @property int|null $department_id แผนก
 * @property string|null $email อีเมล
 * @property string|null $line_id ไลน์
 * @property string|null $phone_number เบอร์ติดต่อ
 * @property string|null $employee_id รหัสพนักงาน
 * @property int|null $role_id สิทธิ์ใช้งาน
 * @property int|null $pdpa
 * @property string|null $reason เหตุผล
 * @property string|null $created_at วันที่ขอ
 * @property string|null $updated_at วันที่บันทึก
 * @property int|null $status_id สถานะ
 * @property string|null $leave_date วันที่ลาออก
 * @property string|null $approve_name ผู้อนุมัติ
 * @property string|null $approve_date วันที่อนุมัติ
 * @property string|null $ref_code REF.
 *
 * @property Computers[] $computers
 * @property Printers[] $printers
 * @property Status $status
 * @property UserClientAuth[] $userClientAuths
 */
class Profile extends \yii\db\ActiveRecord
{
 
    public static function tableName()
    {
        return 'profile';
    }
 
    public static function getDb()
    {
        return Yii::$app->get('dbit');
    }
 
    public function rules()
    {
        return [
            [['user_id', 'title_name', 'thai_name', 'english_name', 'nickname', 'date_of_birth', 'start_date', 'position', 'department_id', 'email', 'line_id', 'phone_number', 'employee_id', 'reason', 'created_at', 'updated_at', 'leave_date', 'approve_name', 'approve_date', 'ref_code'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['user_id', 'title_name', 'department_id', 'role_id', 'pdpa', 'status_id'], 'integer'],
            [['thai_name', 'english_name', 'position', 'reason'], 'string', 'max' => 200],
            [['nickname', 'start_date', 'email', 'line_id', 'employee_id', 'created_at', 'updated_at', 'leave_date', 'approve_name', 'approve_date', 'ref_code'], 'string', 'max' => 45],
            [['date_of_birth'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 15],
            [['user_id'], 'unique'],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'รหัสพนักงาน'),
            'title_name' => Yii::t('app', 'คำนำหน้าชื่อ'),
            'thai_name' => Yii::t('app', 'ชื่อ-สกุล'),
            'english_name' => Yii::t('app', 'English Name'),
            'nickname' => Yii::t('app', 'ชื่อเล่น'),
            'date_of_birth' => Yii::t('app', 'วันเกิด'),
            'start_date' => Yii::t('app', 'วันเริ่มงาน'),
            'position' => Yii::t('app', 'ตำแหน่ง'),
            'department_id' => Yii::t('app', 'แผนก'),
            'email' => Yii::t('app', 'อีเมล'),
            'line_id' => Yii::t('app', 'ไลน์'),
            'phone_number' => Yii::t('app', 'เบอร์ติดต่อ'),
            'employee_id' => Yii::t('app', 'รหัสพนักงาน'),
            'role_id' => Yii::t('app', 'สิทธิ์ใช้งาน'),
            'pdpa' => Yii::t('app', 'Pdpa'),
            'reason' => Yii::t('app', 'เหตุผล'),
            'created_at' => Yii::t('app', 'วันที่ขอ'),
            'updated_at' => Yii::t('app', 'วันที่บันทึก'),
            'status_id' => Yii::t('app', 'สถานะ'),
            'leave_date' => Yii::t('app', 'วันที่ลาออก'),
            'approve_name' => Yii::t('app', 'ผู้อนุมัติ'),
            'approve_date' => Yii::t('app', 'วันที่อนุมัติ'),
            'ref_code' => Yii::t('app', 'REF.'),
        ];
    }
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    public function getDepartment0()
    {
        return $this->hasOne(Departments::class, ['id' => 'department_id']);
    }
 
    public function getComputers()
    {
        return $this->hasMany(Computers::class, ['profile_id' => 'id']);
    }
 
    public function getPrinters()
    {
        return $this->hasMany(Printers::class, ['profile_id' => 'id']);
    }
 
    
 
    public function getUserClientAuths()
    {
        return $this->hasMany(UserClientAuth::class, ['profile_id' => 'id']);
    }

}
