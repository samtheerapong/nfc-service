<?php

namespace app\modules\maintenance\controllers;

use app\modules\maintenance\models\Equipment;
use app\modules\maintenance\models\Frequencies;
use app\modules\maintenance\models\MaintenanceSchedule;
use app\modules\maintenance\models\MaintenanceTypes;
use app\modules\maintenance\models\ScheduleStatuses;
use app\modules\maintenance\models\search\MaintenanceScheduleSearch;
use app\modules\maintenance\models\Technician;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * MaintenanceScheduleController implements the CRUD actions for MaintenanceSchedule model.
 */
class MaintenanceScheduleController extends Controller
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

    /**
     * Lists all MaintenanceSchedule models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MaintenanceScheduleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaintenanceSchedule model.
     * @param int $schedule_id Schedule ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($schedule_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($schedule_id),
        ]);
    }

    /**
     * Creates a new MaintenanceSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MaintenanceSchedule();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $equipments = ArrayHelper::map(Equipment::find()->all(), 'equipment_id', 'equipment_name');
        $technicians = ArrayHelper::map(Technician::find()->all(), 'technician_id', 'first_name');
        $types = ArrayHelper::map(MaintenanceTypes::find()->all(), 'type_id', 'type_name');
        $frequencies = ArrayHelper::map(Frequencies::find()->all(), 'frequency_id', 'frequency_name');
        $statuses = ArrayHelper::map(ScheduleStatuses::find()->all(), 'status_id', 'status_name');
        return $this->render('create', [
            'model' => $model,
            'equipments' => $equipments,
            'technicians' => $technicians,
            'types' => $types,
            'frequencies' => $frequencies,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Updates an existing MaintenanceSchedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $schedule_id Schedule ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($schedule_id)
    {
        $model = MaintenanceSchedule::findOne($schedule_id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $equipments = ArrayHelper::map(Equipment::find()->all(), 'equipment_id', 'equipment_name');
        $technicians = ArrayHelper::map(Technician::find()->all(), 'technician_id', 'first_name');
        $types = ArrayHelper::map(MaintenanceTypes::find()->all(), 'type_id', 'type_name');
        $frequencies = ArrayHelper::map(Frequencies::find()->all(), 'frequency_id', 'frequency_name');
        $statuses = ArrayHelper::map(ScheduleStatuses::find()->all(), 'status_id', 'status_name');
        return $this->render('update', [
            'model' => $model,
            'equipments' => $equipments,
            'technicians' => $technicians,
            'types' => $types,
            'frequencies' => $frequencies,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Deletes an existing MaintenanceSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $schedule_id Schedule ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($schedule_id)
    {
        $this->findModel($schedule_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MaintenanceSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $schedule_id Schedule ID
     * @return MaintenanceSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($schedule_id)
    {
        if (($model = MaintenanceSchedule::findOne(['schedule_id' => $schedule_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
