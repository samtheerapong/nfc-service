<?php

namespace app\modules\stock\controllers;

use Yii;
use app\modules\stock\models\Requisition;
use app\modules\stock\models\Equipment;
use app\modules\stock\models\search\RequisitionSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class RequisitionController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new RequisitionSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Requisition::find()->with('equipment'),
            'pagination' => [
                'pageSize' => 20, // จำกัด 20 รายการต่อหน้า
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproval()
    {
        $searchModel = new RequisitionSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Requisition::find()->with('equipment'),
            'pagination' => [
                'pageSize' => 20, // จำกัด 20 รายการต่อหน้า
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

        return $this->render('approval', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Requisition();
        $equipments = Equipment::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            $equipment = Equipment::findOne($model->equipment_id);
            if ($equipment->stock >= $model->quantity) {
                if ($model->save()) {
                    // อัพเดทสต็อก
                    $equipment->stock -= $model->quantity;
                    $equipment->save();
                    return $this->redirect(['index']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'สต็อกไม่เพียงพอ');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'equipments' => $equipments,
        ]);
    }


    public function actionApprove($id)
    {
        $model = Requisition::findOne($id);
        if ($model) {
            $equipment = Equipment::findOne($model->equipment_id);
            if ($equipment->stock >= $model->quantity) {
                $model->status_id = 2;
                $model->approved_by = 'Admin'; // ควรเปลี่ยนเป็นระบบ user จริง
                $model->approved_at = date('Y-m-d H:i:s');

                if ($model->save()) {
                    $equipment->stock -= $model->quantity;
                    $equipment->save();
                    Yii::$app->session->setFlash('success', 'อนุมัติคำขอเรียบร้อย');
                }
            } else {
                Yii::$app->session->setFlash('error', 'สต็อกไม่เพียงพอ');
            }
        }
        return $this->redirect(['approval']);
    }



    public function actionReject($id)
    {
        $model = Requisition::findOne($id);
        if ($model) {
            $model->status_id = 3;
            $model->approved_by = 'Admin'; // ควรเปลี่ยนเป็นระบบ user จริง
            $model->approved_at = date('Y-m-d H:i:s');
            $model->save();
            Yii::$app->session->setFlash('success', 'ปฏิเสธคำขอเรียบร้อย');
        }
        return $this->redirect(['approval']);
    }

    public function actionCancel($id)
    {
        $model = Requisition::findOne($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('ไม่พบคำขอที่ระบุ');
        }

        if ($model) {
            $model->setStatusToCancel();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'ยกเลิกคำขอเรียบร้อย');
            } else {
                Yii::$app->session->setFlash('error', 'ไม่สามารถยกเลิกได้: ' . implode(', ', $model->getFirstErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'เฉพาะคำขอที่รออยู่เท่านั้นที่ยกเลิกได้');
        }

        return $this->redirect(['index']);
    }
}
