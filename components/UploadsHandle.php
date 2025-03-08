<?php

namespace app\components;

use app\models\Uploads;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;

class UploadsHandle
{



    // public static function getUploadUrl($folder)
    // {
    //     return Url::base(true) . '/' . $folder . '/';
    // }


    // public static function actionUploader()
    // {
    //     self::Uploader(true);
    // }




    public static function Uploader($code, $isAjax = false, $folder)
    {
        if (Yii::$app->request->isPost) {
            $uploads = UploadedFile::getInstancesByName('upload_file');
            if ($uploads) {
                $ref = $code;
                self::CreateDir($ref, $folder);

                foreach ($uploads as $file) {
                    $fileName       = $file->baseName . '.' . $file->extension;
                    $realFileName   = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath       = $folder . '/' . $ref . '/' . $realFileName;
                    if ($file->saveAs($savePath)) {

                        if (self::isImage(Url::base(true) . '/' . $savePath)) {
                        }

                        $model                  = new Uploads();
                        $model->ref             = $ref;
                        $model->file_name       = $fileName;
                        $model->real_filename   = $realFileName;
                        $model->save();

                        if ($isAjax === true) {
                            echo json_encode(['success' => 'true']);
                        }
                    } else {
                        if ($isAjax === true) {
                            echo json_encode(['success' => 'false', 'eror' => $file->error]);
                        }
                    }
                }
            }
        }
    }

    public static function getUploadPath($folder)
    {
        return Yii::getAlias('@webroot') . '/' . $folder . '/';
    }

    public static function createDir($folderName, $folder)
    {
        if ($folderName) {
            $basePath = self::getUploadPath($folder);
            $fullPath = $basePath . $folderName;

            if (!is_dir($fullPath)) {
                BaseFileHelper::createDirectory($fullPath, 0777, true); // Ensure recursive creation
            }

            if (!is_writable($fullPath)) {
                chmod($fullPath, 0777);
            }
        }
    }

    public static function isImage($filePath)
    {
        if (!file_exists($filePath)) {
            return false;
        }
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    // public static function getInitialPreview($code)
    // {
    //     $datas = Uploads::find()->where(['ref' => $code])->all();
    //     $initialPreview = [];
    //     $initialPreviewConfig = [];
    //     foreach ($datas as $key => $value) {
    //         array_push($initialPreview, self::getTemplatePreview($value));
    //         array_push($initialPreviewConfig, [
    //             'type' => 'pdf',  // PDF
    //             'caption' => $value->file_name,
    //             'width'  => '120px',
    //             'url'    => Url::to(['deletefile']),
    //             'key'    => $value->id
    //         ]);
    //     }
    //     return  [$initialPreview, $initialPreviewConfig];
    // }

    // public static function getTemplatePreview(Uploads $model)
    // {
    //     $fileUrl = self::getUploadUrl() . $model->ref . '/' . $model->real_filename;
    //     $fileExt = strtolower(pathinfo($model->real_filename, PATHINFO_EXTENSION));

    //     if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
    //         // แสดงรูปภาพ
    //         return Html::img($fileUrl, [
    //             'class' => 'file-preview-image',
    //             'alt' => $model->file_name,
    //             'title' => $model->file_name,
    //             'style' => 'max-width: 100%; height: auto;',
    //         ]);
    //     } elseif ($fileExt === 'pdf') {
    //         // แสดง PDF
    //         return "<object class='kv-preview-data file-preview-pdf file-zoom-detail' 
    //                  title='{$model->file_name}' data='{$fileUrl}' type='application/pdf' 
    //                  width='100%' height='500px'></object>";
    //     } else {
    //         // ไฟล์ที่ไม่รองรับ แสดงปุ่มดาวน์โหลดแทน
    //         return Html::a(
    //             '<i class="fa fa-download"></i> ดาวน์โหลด ' . $model->file_name,
    //             $fileUrl,
    //             ['class' => 'btn btn-outline-secondary btn-sm', 'target' => '_blank']
    //         );
    //     }
    // }




    // public static function removeUploadDir($dir)
    // {
    //     BaseFileHelper::removeDirectory(self::getUploadPath() . $dir);
    // }


    // public static function getShowImg($code)
    // {
    //     $uploadFiles = Uploads::find()->where(['ref' => $code])->all();
    //     $thumbnails = [];
    //     foreach ($uploadFiles as $file) {
    //         $imageUrl = self::getUploadUrl() . $file->ref . '/' . $file->real_filename;
    //         $thumbnails[] = "<img src='{$imageUrl}' class='img-thumbnail' style='width: 50px; height: 50px; object-fit: cover; margin: 0px;' title='{$file->real_filename}'>";
    //     }
    //     return implode('', $thumbnails); // Combine all thumbnails into a single string
    // }

    // public static function getFirstShowImg($code)
    // {
    //     $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Allowed image formats

    //     $uploadFiles = Uploads::find()
    //         ->where(['ref' => $code])
    //         ->orderBy(['id' => SORT_ASC]) // Ensures first uploaded file is selected
    //         ->all();

    //     foreach ($uploadFiles as $file) {
    //         // Extract the file extension and check if it's an image
    //         $ext = strtolower(pathinfo($file->real_filename, PATHINFO_EXTENSION));
    //         if (in_array($ext, $allowedExtensions)) {
    //             return self::getUploadUrl() . $file->ref . '/' . $file->real_filename;
    //         }
    //     }

    //     // Return a default "no-image" picture if no image files are found
    //     return Yii::getAlias('@web') . '/uploads/no-image.jpg';
    // }

    // public static function getThumbnails($code)
    // {
    //     $uploadFiles = Uploads::find()->where(['ref' => $code])->all();
    //     $preview = [];
    //     foreach ($uploadFiles as $file) {
    //         $preview[] = [
    //             'url' => self::getUploadUrl() . $file->ref . '/' . $file->real_filename,
    //             'src' => self::getUploadUrl() . $file->ref . '/thumbnail/' . $file->real_filename,
    //             'options' => [
    //                 'title' => $file->real_filename,
    //             ],
    //         ];
    //     }
    //     return $preview;
    // }

    // public static function getNoPhoto()
    // {
    //     return Html::img(Yii::getAlias('@web') . '/uploads/no-image.jpg', ['class' => 'img-fluid img-thumbnail mx-auto']);
    // }
}
