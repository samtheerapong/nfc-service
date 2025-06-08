<?php
namespace app\modules\msw\controllers;

use app\modules\msw\models\Budget;
use yii\web\Controller; 
use yii\db\Query;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        $totalBudget = Budget::find()->sum('total_amount');
        $fiscalYears = (new Query())
            ->select(['fiscal_year', 'SUM(total_amount) AS total'])
            ->from('budget')
            ->groupBy('fiscal_year')
            ->all();

        return $this->render('index', [
            'totalBudget' => $totalBudget,
            'fiscalYears' => $fiscalYears,
        ]);
    }
}
