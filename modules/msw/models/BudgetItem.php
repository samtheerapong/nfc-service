<?php

namespace app\modules\msw\models;

use Yii;

/**
 * This is the model class for table "budget_item".
 *
 * @property int $id
 * @property int $budget_id
 * @property string $category
 * @property string|null $sub_category
 * @property float $amount_allocated
 * @property float $amount_used
 * @property string|null $note
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Budget $budget
 */
class BudgetItem extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'budget_item';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbmsw');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_category', 'note'], 'default', 'value' => null],
            [['amount_used'], 'default', 'value' => 0.00],
            [['budget_id', 'category'], 'required'],
            [['budget_id'], 'integer'],
            [['amount_allocated', 'amount_used'], 'number'],
            [['note'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['category', 'sub_category'], 'string', 'max' => 100],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::class, 'targetAttribute' => ['budget_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'budget_id' => Yii::t('app', 'Budget ID'),
            'category' => Yii::t('app', 'Category'),
            'sub_category' => Yii::t('app', 'Sub Category'),
            'amount_allocated' => Yii::t('app', 'Amount Allocated'),
            'amount_used' => Yii::t('app', 'Amount Used'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Budget]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::class, ['id' => 'budget_id']);
    }

}
