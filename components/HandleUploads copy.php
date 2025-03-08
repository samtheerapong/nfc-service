<?php

namespace app\components;

use app\models\Uploads;
use yii\imagine\Image;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;

class HandleUploads
{
    const IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    const NO_IMAGE_PATH = '/img/nopic.jpg';
    const RESIZE_QUALITY = 70;

    public static function uploader($ref, $isAjax = false, $folder)
    {
        if (!Yii::$app->request->isPost) return;

        $uploads = UploadedFile::getInstancesByName('upload_file');
        if (!$uploads) return;

        self::createDir($ref, $folder);

        foreach ($uploads as $file) {
            $fileName = $file->baseName . '.' . $file->extension;
            $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
            $savePath = "$folder/$ref/$realFileName";

            if (!$file->saveAs($savePath)) {
                if ($isAjax) echo json_encode(['success' => false, 'error' => $file->error]);
                continue;
            }

            if (self::isImage($savePath)) self::resizeImage($savePath);

            $model = new Uploads(['ref' => $ref, 'file_name' => $fileName, 'real_filename' => $realFileName]);
            if ($model->save() && $isAjax) echo json_encode(['success' => true]);
        }
    }

    public static function createDir($ref, $folder)
    {
        if (!$ref) return;

        $fullPath = self::getUploadPath($folder) . $ref;
        if (!is_dir($fullPath)) {
            BaseFileHelper::createDirectory($fullPath, 0777, true);
            BaseFileHelper::createDirectory("$fullPath/thumb", 0777, true);
        }

        if (!is_writable($fullPath)) chmod($fullPath, 0777);
    }

    public static function getUploadPath($folder)
    {
        return Yii::getAlias('@webroot') . "/$folder/";
    }

    public static function getUploadUrl($folder)
    {
        return Url::base(true) . "/$folder/";
    }

    public static function isImage($filePath)
    {
        return file_exists($filePath) && @is_array(getimagesize($filePath));
    }

    public static function resizeImage($filePath)
    {
        if (!self::isImage($filePath)) return false;

        Image::getImagine()->open($filePath)->save($filePath, ['quality' => self::RESIZE_QUALITY]);
        return true;
    }

    public static function getInitialPreview($ref, $folder)
    {
        $datas = Uploads::find()->where(['ref' => $ref])->all();
        $initialPreview = $initialPreviewConfig = [];

        foreach ($datas as $value) {
            $initialPreview[] = self::getTemplatePreview($value, $folder);
            $initialPreviewConfig[] = [
                'type' => 'pdf',  // PDF
                'caption' => $value->file_name,
                'width'  => '120px',
                'url'    => Url::to(['deletefile']),
                'key'    => $value->id
            ];
        }

        return [$initialPreview, $initialPreviewConfig];
    }

    public static function getTemplatePreview(Uploads $model, $folder)
    {
        $fileUrl = self::getUploadUrl($folder) . "$model->ref/$model->real_filename";
        $fileExt = strtolower(pathinfo($model->real_filename, PATHINFO_EXTENSION));

        if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
            return Html::img($fileUrl, ['class' => 'file-preview-image', 'alt' => $model->file_name, 'title' => $model->file_name, 'style' => 'max-width: 100%; height: auto;']);
        } elseif ($fileExt === 'pdf') {
            return "<object class='kv-preview-data file-preview-pdf file-zoom-detail' title='{$model->file_name}' data='{$fileUrl}' type='application/pdf' width='100%' height='500px'></object>";
        } else {
            return Html::a('<i class="fa fa-download"></i> Download', $fileUrl, ['class' => 'btn btn-danger btn-xs', 'target' => '_blank']);
        }
    }

    public static function getFirstShowImg($ref, $folder)
    {
        $uploadFiles = Uploads::find()->where(['ref' => $ref])->orderBy(['id' => SORT_ASC])->all();

        foreach ($uploadFiles as $file) {
            $ext = strtolower(pathinfo($file->real_filename, PATHINFO_EXTENSION));
            if (in_array($ext, self::IMAGE_EXTENSIONS)) {
                return self::getUploadUrl($folder) . "$file->ref/$file->real_filename";
            }
        }

        return Yii::getAlias('@web') . self::NO_IMAGE_PATH;
    }

    public static function getShowAllImages($ref, $folder)
    {
        $uploadFiles = Uploads::find()->where(['ref' => $ref])->orderBy(['id' => SORT_ASC])->all();
        $imageUrls = [];

        foreach ($uploadFiles as $file) {
            $ext = strtolower(pathinfo($file->real_filename, PATHINFO_EXTENSION));
            if (in_array($ext, self::IMAGE_EXTENSIONS)) {
                $imageUrls[] = self::getUploadUrl($folder) . "$file->ref/$file->real_filename";
            }
        }

        return $imageUrls ?: [];
    }

    public static function getShowImage($ref, $folder)
    {
        $uploadFiles   = Uploads::find()->where(['ref' => $ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url' => self::getUploadUrl($folder, true) . $ref . '/' . $file->real_filename,
                'src' => self::getUploadUrl($folder, true) . $ref . '/' . $file->real_filename,
                'options' => [
                    'title' => $file->file_name,
                ],
            ];
        }
        return $preview;
    }

    public static function getNoImage()
    {
        return Html::img(Yii::getAlias('@web') . self::NO_IMAGE_PATH, ['class' => 'img-fluid img-thumbnail mx-auto']);
    }
}
