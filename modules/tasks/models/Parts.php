<?php

namespace app\modules\tasks\models;

use Yii;

/**
 * This is the model class for table "parts".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property string|null $description รายละเอียด
 * @property int|null $group_id กลุ่ม
 * @property int|null $category_id หวดหมู่
 * @property int|null $type_id ประเภท
 * @property string|null $location สถานที่
 * @property string|null $serial_code ซีเรียลนัมเบอร์
 * @property string|null $asset_code รหัสสินทรัพย์
 * @property string|null $last_install ติดตั้งล่าสุด
 * @property int|null $quantity_in_stock จำนวนสต๊อก
 * @property float|null $unit_cost ราคาต่อหน่วย
 * @property string|null $unit หน่วย
 * @property int|null $min_stock สต๊อกน้อยสุด
 * @property string|null $last_update วันที่ล่าสุด
 * @property string|null $remask หมายเหตุ
 * @property int|null $status_id สถานะ
 *
 * @property MachineBom[] $machineBoms
 * @property MachineBom[] $machineBoms0
 */
class Parts extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parts';
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
            [['code', 'name', 'description', 'group_id', 'category_id', 'type_id', 'location', 'serial_code', 'asset_code', 'last_install', 'unit_cost', 'unit', 'min_stock', 'last_update', 'remask'], 'default', 'value' => null],
            [['quantity_in_stock'], 'default', 'value' => 0],
            [['status_id'], 'default', 'value' => 1],
            [['description'], 'string'],
            [['group_id', 'category_id', 'type_id', 'quantity_in_stock', 'min_stock', 'status_id'], 'integer'],
            [['unit_cost'], 'number'],
            [['code', 'last_install', 'unit', 'last_update'], 'string', 'max' => 45],
            [['name', 'location', 'serial_code', 'asset_code', 'remask'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'รหัส'),
            'name' => Yii::t('app', 'ชื่อ'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'group_id' => Yii::t('app', 'กลุ่ม'),
            'category_id' => Yii::t('app', 'หวดหมู่'),
            'type_id' => Yii::t('app', 'ประเภท'),
            'location' => Yii::t('app', 'สถานที่'),
            'serial_code' => Yii::t('app', 'ซีเรียลนัมเบอร์'),
            'asset_code' => Yii::t('app', 'รหัสสินทรัพย์'),
            'last_install' => Yii::t('app', 'ติดตั้งล่าสุด'),
            'quantity_in_stock' => Yii::t('app', 'จำนวนสต๊อก'),
            'unit_cost' => Yii::t('app', 'ราคาต่อหน่วย'),
            'unit' => Yii::t('app', 'หน่วย'),
            'min_stock' => Yii::t('app', 'สต๊อกน้อยสุด'),
            'last_update' => Yii::t('app', 'วันที่ล่าสุด'),
            'remask' => Yii::t('app', 'หมายเหตุ'),
            'status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[MachineBoms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentBoms()
    {
        return $this->hasMany(MachineBom::class, ['parent_part_id' => 'id']);
    }

    /**
     * Gets query for [[MachineBoms0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildBoms()
    {
        return $this->hasMany(MachineBom::class, ['child_part_id' => 'id']);
    }

}
