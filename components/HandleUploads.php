<?php

namespace app\components;

use app\models\Uploads;
use yii\imagine\Image;
use Yii;
use yii\helpers\{Url, BaseFileHelper, Html};
use yii\web\UploadedFile;

class HandleUploads
{
    private const IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private const NO_IMAGE_PATH = '/img/nopic.jpg';
    private const RESIZE_QUALITY = 70;

    public static function uploader($ref, $isAjax = false, $folder): void
    {
        if (!Yii::$app->request->isPost || !$ref) return;

        $uploads = UploadedFile::getInstancesByName('upload_file');
        if (empty($uploads)) return;

        self::createDir($ref, $folder);

        foreach ($uploads as $file) {
            $fileName = $file->baseName . '.' . $file->extension;
            $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
            $savePath = "$folder/$ref/$realFileName";

            if (!$file->saveAs($savePath)) {
                if ($isAjax) echo json_encode(['success' => false, 'error' => $file->error]);
                continue;
            }

            if (self::isImage($savePath)) {
                self::resizeImage($savePath);
            }

            $model = new Uploads(['ref' => $ref, 'file_name' => $fileName, 'real_filename' => $realFileName]);
            if ($model->save() && $isAjax) {
                echo json_encode(['success' => true]);
            }
        }
    }

    private static function createDir($ref, $folder): void
    {
        $fullPath = self::getUploadPath($folder) . $ref;
        if (!is_dir($fullPath)) {
            BaseFileHelper::createDirectory("$fullPath", 0777, true);
        }
        if (!is_writable($fullPath)) {
            chmod($fullPath, 0777);
        }
    }

    public static function getUploadPath($folder): string
    {
        return Yii::getAlias('@webroot') . "/$folder/";
    }

    public static function getUploadUrl($folder): string
    {
        return Url::base(true) . "/$folder/";
    }

    private static function isImage($filePath): bool
    {
        return file_exists($filePath) && @is_array(getimagesize($filePath));
    }

    private static function resizeImage($filePath): void
    {
        Image::getImagine()->open($filePath)->save($filePath, ['quality' => self::RESIZE_QUALITY]);
    }

    public static function getInitialPreview($ref, $folder): array
    {
        $datas = Uploads::findAll(['ref' => $ref]);
        $preview = [];
        $config = [];

        foreach ($datas as $value) {
            $preview[] = self::getTemplatePreview($value, $folder);
            $config[] = [
                'type' => 'pdf',
                'caption' => $value->file_name,
                'width' => '120px',
                'url' => Url::to(['deletefile']),
                'key' => $value->id
            ];
        }

        return [$preview, $config];
    }

    private static function getTemplatePreview(Uploads $model, $folder): string
    {
        $fileUrl = self::getUploadUrl($folder) . "$model->ref/$model->real_filename";
        $fileExt = strtolower(pathinfo($model->real_filename, PATHINFO_EXTENSION));

        if (in_array($fileExt, self::IMAGE_EXTENSIONS)) {
            return Html::img($fileUrl, [
                'class' => 'file-preview-image',
                'alt' => $model->file_name,
                'title' => $model->file_name,
                'style' => 'max-width: 100%; height: auto;'
            ]);
        }

        if ($fileExt === 'pdf') {
            return "<object class='kv-preview-data file-preview-pdf file-zoom-detail' title='$model->file_name' data='$fileUrl' type='application/pdf' width='100%' height='500px'></object>";
        }

        return Html::a('<i class="fa fa-download"></i> Download', $fileUrl, [
            'class' => 'btn btn-danger btn-xs',
            'target' => '_blank'
        ]);
    }

    public static function getFirstShowImg($ref, $folder): string
    {
        foreach (Uploads::find()->where(['ref' => $ref])->orderBy(['id' => SORT_ASC])->all() as $file) {
            if (in_array(strtolower(pathinfo($file->real_filename, PATHINFO_EXTENSION)), self::IMAGE_EXTENSIONS)) {
                return self::getUploadUrl($folder) . "$file->ref/$file->real_filename";
            }
        }
        return Yii::getAlias('@web') . self::NO_IMAGE_PATH;
    }

    public static function getShowAllImages($ref, $folder): array
    {
        return array_map(
            fn($file) => self::getUploadUrl($folder) . "$file->ref/$file->real_filename",
            array_filter(
                Uploads::find()->where(['ref' => $ref])->orderBy(['id' => SORT_ASC])->all(),
                fn($file) => in_array(strtolower(pathinfo($file->real_filename, PATHINFO_EXTENSION)), self::IMAGE_EXTENSIONS)
            )
        );
    }

    public static function getShowImage($ref, $folder): array
    {
        return array_map(
            fn($file) => [
                'url' => $url = self::getUploadUrl($folder) . "$ref/$file->real_filename",
                'src' => $url,
                'options' => ['title' => $file->file_name]
            ],
            Uploads::findAll(['ref' => $ref])
        );
    }

    public static function getNoImage(): string
    {
        return Html::img(Yii::getAlias('@web') . self::NO_IMAGE_PATH, ['class' => 'img-fluid img-thumbnail mx-auto']);
    }
}
