<?php

namespace app\modules\tasks\controllers;

use app\components\HandleUploads;
use app\modules\tasks\models\AutoNumber;
use app\modules\tasks\models\WorkOrder;
use app\modules\tasks\models\search\WorkOrderSearch;
use app\modules\tasks\models\Ticket;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
 
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
        $searchModel = new WorkOrderSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => WorkOrder::find(),
            'pagination' => [
                'pageSize' => 4,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC], // ล่าสุดก่อน
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
 
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
 
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
            $model->getUploads();
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
 
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        list($initialPreview, $initialPreviewConfig) = HandleUploads::getInitialPreview($model->work_order_code, WorkOrder::UPLOAD_FOLDER);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->getUploads();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ]);
    }

    public function actionApproval($id)
    {
        $model = $this->findModel($id);
        $modelTicket = Ticket::findOne(['id' => $model->ticket_id]);

        if (!$modelTicket) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested ticket does not exist.'));
        }

        $today = date("Y-m-d");
        $identity = Yii::$app->user->identity ?: 'Anonymous';

        if ($this->request->isPost && $model->load($this->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->approve_name = $identity->thai_name;
                $model->approve_date = $today;

                if ($model->save()) {
                    $modelTicket->status_id = 4; // Engineer Approved
                    if ($modelTicket->save()) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Approval successful and ticket status updated.'));
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        throw new Exception(Yii::t('app', 'Failed to update ticket status.'));
                    }
                } else {
                    throw new Exception(Yii::t('app', 'Failed to save work order.'));
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('approval', [
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
        if (($model = WorkOrder::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
