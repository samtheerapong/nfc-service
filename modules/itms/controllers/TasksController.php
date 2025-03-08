<?php

namespace app\modules\itms\controllers;

use app\modules\itms\models\AutoNumber;
use app\modules\itms\models\Tasks;
use app\modules\itms\models\search\TasksSearch;
use app\modules\itms\models\TaskActions;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TasksController extends Controller
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
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListView()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('list-view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        // ดึง TaskAction ล่าสุดที่เกี่ยวข้อง (หรือปรับเงื่อนไขตามต้องการ)
        $taskAction = TaskActions::find()
            ->where(['task_code' => $model->ref_code])
            ->orderBy(['id' => SORT_DESC]) // เรียงจากใหม่ไปเก่า
            ->one();

        return $this->render('view', [
            'model' => $model,
            'taskAction' => $taskAction, // ส่ง TaskAction ไปแทน DataProvider
        ]);
    }

    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);


    //     $taskActionsDataProvider = new ActiveDataProvider([
    //         'query' => TaskActions::find()->where(['task_code' => $model->ref_code]),
    //         'pagination' => [
    //             'pageSize' => 10, // จำนวนรายการต่อหน้า
    //         ],
    //     ]);

    //     return $this->render('view', [
    //         'model' => $model,
    //         'taskActionsDataProvider' => $taskActionsDataProvider,
    //     ]);
    // }

    public function actionCreate()
    {
        $model = new Tasks();

        $model->task_year = date('Y');
        $model->task_month = date('m');
        $model->task_date = date('Y-m-d');
        $model->status_id = 1;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ref_code = AutoNumber::generate('TR' . date('y') . date('m') . '-????'); // Auto Number

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionTaskAction($id)
    {
        $model = new TaskActions();
        $modelTask = $this->findModel($id);

        $model->task_code = $modelTask->ref_code;
        $model->start_date = $model->end_date = date('Y-m-d');

        if (
            $this->request->isPost
            && $model->load($this->request->post())
            && $modelTask->load($this->request->post())
            && $model->validate()
            && $modelTask->validate()
        ) {
            $model->action_code = Autonumber::generate('TA' . (date('y') + 43) . date('m') . '-????');
            if ($model->save(false) && $modelTask->save(false)) {
                Yii::$app->session->setFlash('success', 'Success');
                return $this->redirect(['view', 'id' => $id]);
            }
            Yii::$app->session->setFlash('error', 'Failed');
        }

        return $this->render('task_action', [
            'model' => $model,
            'modelTask' => $modelTask,
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
        if (($model = Tasks::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
