<?php

namespace app\components;

use app\models\Uploads;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;

class HandleUploads
{
    public static function uploader($ref, $folder, $isAjax = false)
    {
        if (Yii::$app->request->isPost) {
            $uploads = UploadedFile::getInstancesByName('upload_file');
            if ($uploads) {
                self::createDir($ref, $folder);

                foreach ($uploads as $file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $realFileName = md5($file->baseName . time()) . '.' . $file->extension;
                    $savePath = self::getUploadPath($folder) . $ref . '/' . $realFileName;

                    if ($file->saveAs($savePath)) {
                        if (self::isImage($savePath)) {
                            self::createThumbnail($ref, $realFileName, $folder);
                        }

                        $model = new Uploads();
                        $model->ref = $ref;
                        $model->file_name = $fileName;
                        $model->real_filename = $realFileName;
                        $model->save();
                    }
                }
            }
        }
    }

    public static function createThumbnail($folderName, $fileName, $folder)
    {
        $uploadPath = self::getUploadPath($folder) . $folderName . '/';
        $thumbPath = $uploadPath . 'thumb/';

        if (!is_dir($thumbPath)) {
            BaseFileHelper::createDirectory($thumbPath, 0777, true);
        }

        $file = $uploadPath . $fileName;
        if (!file_exists($file)) {
            return;
        }

        $image = Yii::$app->image->load($file);
        $image->resize(250);
        $image->save($thumbPath . $fileName);
    }

    public static function getUploadPath($folder)
    {
        return Yii::getAlias('@webroot') . '/' . $folder . '/';
    }

    public static function createDir($folderName, $folder)
    {
        $basePath = self::getUploadPath($folder) . $folderName;
        if (!is_dir($basePath)) {
            BaseFileHelper::createDirectory($basePath, 0777, true);
        }
    }

    public static function isImage($filePath)
    {
        return @is_array(getimagesize($filePath));
    }

     // public static function resizeImage($filePath, $newHeight = 1600, $quality = 90)
    // {
    //     if (!self::isImage($filePath)) {
    //         return false;
    //     }

    //     // Load the image
    //     $image = Image::getImagine()->open($filePath);

    //     // Get the original size
    //     $size = $image->getSize();
    //     $originalWidth = $size->getWidth();
    //     $originalHeight = $size->getHeight();

    //     // Calculate new width while keeping the aspect ratio
    //     $newWidth = intval(($newHeight / $originalHeight) * $originalWidth);

    //     // Resize the image
    //     $image->resize(new Box($newWidth, $newHeight))
    //           ->save($filePath, ['quality' => $quality]);

    //     return true;
    // }
}
