<?php

namespace app\modules\tasks\models;

use Yii;

/**
 * This is the model class for table "machine_bom".
 *
 * @property int $id
 * @property int $machine_id เครื่องจักร
 * @property int $parent_part_id อะไหล่หลัก
 * @property int $child_part_id อะไหล่รอง
 * @property int|null $quantity_required จำนวน
 * @property int|null $level ชั้นโครงสร้าง
 * @property string|null $unit หน่วย
 * @property string|null $bom_date วันที่
 * @property int|null $status_id สถานะ
 *
 * @property Parts $childPart
 * @property Machine $machine
 * @property Parts $parentPart
 */
class MachineBom extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'machine_bom';
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
            [['quantity_required', 'unit', 'bom_date'], 'default', 'value' => null],
            [['status_id'], 'default', 'value' => 1],
            [['machine_id', 'parent_part_id', 'child_part_id'], 'required'],
            [['machine_id', 'parent_part_id', 'child_part_id', 'quantity_required', 'level', 'status_id'], 'integer'],
            [['unit', 'bom_date'], 'string', 'max' => 45],
            [['machine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Machine::class, 'targetAttribute' => ['machine_id' => 'id']],
            [['parent_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parts::class, 'targetAttribute' => ['parent_part_id' => 'id']],
            [['child_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parts::class, 'targetAttribute' => ['child_part_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'machine_id' => Yii::t('app', 'เครื่องจักร'),
            'parent_part_id' => Yii::t('app', 'อะไหล่หลัก'),
            'child_part_id' => Yii::t('app', 'อะไหล่รอง'),
            'quantity_required' => Yii::t('app', 'จำนวน'),
            'level' => Yii::t('app', 'ชั้นโครงสร้าง'),
            'unit' => Yii::t('app', 'หน่วย'),
            'bom_date' => Yii::t('app', 'วันที่'),
            'status_id' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * Gets query for [[Machine]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMachine()
    {
        return $this->hasOne(Machine::class, ['id' => 'machine_id']);
    }

    /**
     * Gets query for [[ChildPart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildPart()
    {
        return $this->hasOne(Parts::class, ['id' => 'child_part_id']);
    }

    /**
     * Gets query for [[ParentPart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentPart()
    {
        return $this->hasOne(Parts::class, ['id' => 'parent_part_id']);
    }
}
