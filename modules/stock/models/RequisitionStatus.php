<?php

namespace app\modules\stock\models;

use Yii;

/**
 * This is the model class for table "requisition_status".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int|null $is_active
 *
 * @property Requisition[] $requisitions
 */
class RequisitionStatus extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisition_status';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbstock');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active'], 'default', 'value' => 1],
            [['code', 'name'], 'required'],
            [['is_active'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }

    /**
     * Gets query for [[Requisitions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequisitions()
    {
        return $this->hasMany(Requisition::class, ['status_id' => 'id']);
    }

}
