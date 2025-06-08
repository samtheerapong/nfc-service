<?php

namespace app\modules\msw\controllers;

use app\modules\msw\models\Budget;
use app\modules\msw\models\BudgetItem;
use app\modules\msw\models\BudgetSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BudgetController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new BudgetSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $budgetItemProvider = new ActiveDataProvider([
            'query' => $model->getBudgetItems(),
        ]);

        $budgetItemModel = new BudgetItem();

        return $this->render('view', [
            'model' => $model,
            'budgetItemProvider' => $budgetItemProvider,
            'budgetItemModel' => $budgetItemModel,
        ]);
    }


    public function actionCreate()
    {
        $model = new Budget();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Budget::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionDashboard()
    {
        $totalBudget = Budget::find()->sum('total_amount');
        $fiscalYears = Budget::find()
            ->select(['fiscal_year', 'SUM(total_amount) AS total'])
            ->groupBy('fiscal_year')
            ->asArray()
            ->all();

        return $this->render('dashboard', [
            'totalBudget' => $totalBudget,
            'fiscalYears' => $fiscalYears,
        ]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        // if (Yii::$app->user->can('approveBudget')) {
        $model->status = 'approved';
        $model->save(false);
        // }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        // if (Yii::$app->user->can('approveBudget')) {
        $model->status = 'rejected';
        $model->save(false);
        // }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionAddItem($budget_id)
    {
        $model = new BudgetItem();
        $model->budget_id = $budget_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'เพิ่มรายการสำเร็จ');
        }

        return $this->redirect(['view', 'id' => $budget_id]);
    }
}
