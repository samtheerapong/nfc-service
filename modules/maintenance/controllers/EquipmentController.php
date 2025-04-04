<?php

namespace app\modules\maintenance\controllers;

use app\modules\maintenance\models\Equipment;
use app\modules\maintenance\models\EquipmentStatuses;
use app\modules\maintenance\models\EquipmentTypes;
use app\modules\maintenance\models\search\EquipmentSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * EquipmentController implements the CRUD actions for Equipment model.
 */
class EquipmentController extends Controller
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
     * Lists all Equipment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EquipmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipment model.
     * @param int $equipment_id Equipment ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($equipment_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($equipment_id),
        ]);
    }

    /**
     * Creates a new Equipment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Equipment();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $types = ArrayHelper::map(EquipmentTypes::find()->all(), 'type_id', 'type_name');
        $statuses = ArrayHelper::map(EquipmentStatuses::find()->all(), 'status_id', 'status_name');
        return $this->render('create', [
            'model' => $model,
            'types' => $types,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Updates an existing Equipment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $equipment_id Equipment ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($equipment_id)
    {
        $model = Equipment::findOne($equipment_id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        $types = ArrayHelper::map(EquipmentTypes::find()->all(), 'type_id', 'type_name');
        $statuses = ArrayHelper::map(EquipmentStatuses::find()->all(), 'status_id', 'status_name');
        return $this->render('update', [
            'model' => $model,
            'types' => $types,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Deletes an existing Equipment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $equipment_id Equipment ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($equipment_id)
    {
        $this->findModel($equipment_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Equipment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $equipment_id Equipment ID
     * @return Equipment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($equipment_id)
    {
        if (($model = Equipment::findOne(['equipment_id' => $equipment_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
