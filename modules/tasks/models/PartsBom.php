<?php

namespace app\modules\tasks\models;

use Yii;

/**
 * This is the model class for table "parts_bom".
 *
 * @property int $id
 * @property int|null $parent_part_id ชิ้นส่วนหลัก
 * @property int|null $child_part_id ชิ้นส่วนย่อย
 * @property int|null $quantity_required จำนวน
 *
 * @property Parts $childPart
 * @property Parts $parentPart
 */
class PartsBom extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parts_bom';
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
            [['parent_part_id', 'child_part_id'], 'default', 'value' => null],
            [['quantity_required'], 'default', 'value' => 1],
            [['parent_part_id', 'child_part_id', 'quantity_required'], 'integer'],
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
            'parent_part_id' => Yii::t('app', 'ชิ้นส่วนหลัก'),
            'child_part_id' => Yii::t('app', 'ชิ้นส่วนย่อย'),
            'quantity_required' => Yii::t('app', 'จำนวน'),
        ];
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
