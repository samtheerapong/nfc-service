<?php

namespace app\modules\msw\models;

use Yii;

class Budget extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'budget';
    }

    public static function getDb()
    {
        return Yii::$app->get('dbmsw');
    }

    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['total_amount'], 'default', 'value' => 0.00],
            [['fiscal_year', 'project_name', 'created_by'], 'required'],
            [['fiscal_year', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['total_amount'], 'number'],
            [['created_by'], 'integer'],
            [['project_name'], 'string', 'max' => 255],
            [['status'], 'in', 'range' => ['pending', 'approved', 'rejected']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fiscal_year' => Yii::t('app', 'Fiscal Year'),
            'project_name' => Yii::t('app', 'Project Name'),
            'description' => Yii::t('app', 'Description'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getBudgetItems()
    {
        return $this->hasMany(BudgetItem::class, ['budget_id' => 'id']);
    }
}
