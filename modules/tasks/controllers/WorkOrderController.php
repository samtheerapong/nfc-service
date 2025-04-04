<?php

namespace app\modules\tasks\controllers;

use app\modules\tasks\models\AutoNumber;
use app\modules\tasks\models\WorkOrder;
use app\modules\tasks\models\search\WorkOrderSearch;
use app\modules\tasks\models\Ticket;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkOrderController implements the CRUD actions for WorkOrder model.
 */
class WorkOrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all WorkOrder models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WorkOrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkOrder model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WorkOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new WorkOrder();

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

    public function actionAddWorkOrder($ticket_id)
    {
        $model = new WorkOrder();
        $modelTicket = Ticket::findOne(['id' => $ticket_id]);

        if (!$modelTicket) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested ticket does not exist.'));
        }

        $dateNow = date('Y-m-d');

        // Set default values for the WorkOrder model
        $model->priority_id = $model->priority_id ?: 1;
        $model->ticket_id = $ticket_id;
        $model->start_date = $dateNow;
        $model->end_date = $dateNow;
        $model->hours = 0;
        $model->cost = 0;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->work_order_code = AutoNumber::generate('WO-' . (date('y') + 43) . date('m') . '-????'); // Generate Auto Number

            if ($model->save()) {
                // Update the ticket's status to "In Progress"
                $modelTicket->status_id = 3; // In Progress
                if ($modelTicket->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Work order created and ticket status updated successfully.'));
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Failed to update ticket status.'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Failed to save work order.'));
            }
        }

        return $this->render('add-work-order', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WorkOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Deletes an existing WorkOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WorkOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return WorkOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkOrder::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
