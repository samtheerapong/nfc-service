<?php

namespace app\modules\tasks\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property int $id
 * @property string|null $code รหัส
 * @property string|null $name ชื่อ
 * @property string|null $description รายละเอียด
 * @property int|null $type_id ประเภท
 * @property string|null $serial_code ซีเรียลนัมเบอร์
 * @property string|null $asset_code รหัสสินทรัพย์
 * @property string|null $location สถานที่
 * @property string|null $last_install ติดตั้งล่าสุด
 * @property int|null $quantity_in_stock
 * @property string|null $cost ราคา
 * @property string|null $unit
 * @property string|null $last_update วันที่ล่าสุด
 * @property string|null $remask หมายเหตุ
 * @property int|null $status_id สถานะ
 *
 * @property MachineBom[] $machineBoms
 */
class Machine extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'machine';
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
            [['code', 'name', 'description', 'type_id', 'serial_code', 'asset_code', 'location', 'last_install', 'cost', 'unit', 'last_update', 'remask'], 'default', 'value' => null],
            [['quantity_in_stock'], 'default', 'value' => 0],
            [['status_id'], 'default', 'value' => 1],
            [['description'], 'string'],
            [['type_id', 'quantity_in_stock', 'status_id'], 'integer'],
            [['code', 'last_install', 'cost', 'unit', 'last_update'], 'string', 'max' => 45],
            [['name', 'serial_code', 'asset_code', 'location', 'remask'], 'string', 'max' => 100],
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
            'type_id' => Yii::t('app', 'ประเภท'),
            'serial_code' => Yii::t('app', 'ซีเรียลนัมเบอร์'),
            'asset_code' => Yii::t('app', 'รหัสสินทรัพย์'),
            'location' => Yii::t('app', 'สถานที่'),
            'last_install' => Yii::t('app', 'ติดตั้งล่าสุด'),
            'quantity_in_stock' => Yii::t('app', 'Quantity In Stock'),
            'cost' => Yii::t('app', 'ราคา'),
            'unit' => Yii::t('app', 'Unit'),
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
    public function getMachineBoms()
    {
        return $this->hasMany(MachineBom::class, ['machine_id' => 'id']);
    }

}
