<?php

namespace app\modules\stock\controllers;

use Yii;
use app\modules\stock\models\Requisition;
use app\modules\stock\models\Equipment;
use yii\web\Controller;

class RequisitionController extends Controller
{
    public function actionIndex()
    {
        $requisitions = Requisition::find()->with('equipment')->all();
        return $this->render('index', [
            'requisitions' => $requisitions,
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
        if ($model && $model->status == 'pending') {
            $equipment = Equipment::findOne($model->equipment_id);
            if ($equipment->stock >= $model->quantity) {
                $model->status = 'approved';
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
        return $this->redirect(['index']);
    }



    public function actionReject($id)
    {
        $model = Requisition::findOne($id);
        if ($model && $model->status == 'pending') {
            $model->status = 'rejected';
            $model->approved_by = 'Admin'; // ควรเปลี่ยนเป็นระบบ user จริง
            $model->approved_at = date('Y-m-d H:i:s');
            $model->save();
            Yii::$app->session->setFlash('success', 'ปฏิเสธคำขอเรียบร้อย');
        }
        return $this->redirect(['index']);
    }
}
