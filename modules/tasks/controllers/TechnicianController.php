<?php

namespace app\modules\tasks\controllers;

use Yii;
use app\models\Uploads;
use app\components\HandleUploads;
use app\modules\tasks\models\Technician;
use app\modules\tasks\models\search\TechnicianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TechnicianController extends Controller
{

    // กฎ
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

    // Index
    public function actionIndex()
    {
        $searchModel = new TechnicianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('list-view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // View
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    // Create
    public function actionCreate()
    {
        $model = new Technician();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ref =  $model->users->username;
                $model->thainame =  $model->users->thai_name;
                $model->getUploads();

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


    // Update
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        list($initialPreview, $initialPreviewConfig) = HandleUploads::getInitialPreview($model->ref, Technician::UPLOAD_FOLDER);

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

    // Delete
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->removeUploadDir($model->ref);

        Uploads::deleteAll(['ref' => $model->ref]);

        $model->delete();

        return $this->redirect(['index']);
    }

    public function removeUploadDir($ref)
    {
        $basePath = HandleUploads::getUploadPath(Technician::UPLOAD_FOLDER);
        $uploadDir = $basePath . $ref;
        if (is_dir($uploadDir)) {
            $files = array_diff(scandir($uploadDir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$uploadDir/$file")) ? $this->removeUploadDir("$ref/$file") : unlink("$uploadDir/$file");
            }
            return rmdir($uploadDir);
        }

        return false;
    }

    // findModel
    protected function findModel($id)
    {
        if (($model = Technician::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    //  ดาวน์โหลดไฟล์
    public function actionDownload($id)
    {
        $file = Uploads::findOne($id);

        if ($file !== null) {
            $filePath = HandleUploads::getUploadPath(Technician::UPLOAD_FOLDER) . $file->ref . '/' . $file->real_filename;

            if (file_exists($filePath)) {
                return Yii::$app->response->sendFile($filePath, $file->file_name);
            } else {
                Yii::$app->session->setFlash('error', 'ไม่พบไฟล์ที่ต้องการดาวน์โหลด');
            }
        } else {
            Yii::$app->session->setFlash('error', 'ไม่พบข้อมูลไฟล์');
        }

        return $this->redirect(['view', 'id' => $file->ref]);
    }

    //  ลบไฟล์จากปุ่มในฟอร์ม
    public function actionDeletefile()
    {
        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename  = HandleUploads::getUploadPath(Technician::UPLOAD_FOLDER) . $model->ref . '/' . $model->real_filename;
            $thumbnail = HandleUploads::getUploadPath(Technician::UPLOAD_FOLDER) . $model->ref . '/thumb/' . $model->real_filename;
            if ($model->delete()) {
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
