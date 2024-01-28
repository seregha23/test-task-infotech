<?php

namespace app\services;

use app\models\Base;
use Yii;
use yii\helpers\BaseStringHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;

class ImagesService
{
    const IMAGE_TYPE_ORIGIN_POSTFIX = '_origin';
    const IMAGE_TYPE_PREVIEW_POSTFIX = '_preview';

    protected static ?ImagesService $_instance = null;

    public static function getInstance(Base $model, UploadedFile $image): static
    {
        self::$_instance ??= new static($model, $image);
        return self::$_instance;
    }

    protected function __construct(public ?Base $model, public ?UploadedFile $image)
    {
    }

    public function saveImage(): void
    {
        if (!is_dir($this->getImageDir())) {
            mkdir($this->getImageDir(), 0755, true);
        }
        $this->image->saveAs($this->getOriginImagePath());

        $this->createPreviewImage();

        $this->setImageAttributes();
    }

    public function getFileName(): string
    {
        return $this->model->id . '.' . $this->image->extension;
    }

    public function getOriginImagePath(): string
    {
        return $this->getImageDir() . '/' . $this->model->id . ImagesService::IMAGE_TYPE_ORIGIN_POSTFIX . '.' . $this->image->extension;
    }

    public function getPreviewImagePath(): string
    {
        return $this->getImageDir() . '/' . $this->model->id . ImagesService::IMAGE_TYPE_PREVIEW_POSTFIX . '.' . $this->image->extension;
    }

    public function getImageDir(): string
    {
        return Yii::getAlias('@static') . '/images/' . mb_strtolower(BaseStringHelper::basename(get_class($this->model)));
    }

    public function setImageAttributes(): void
    {
        $attributes = [
            'image_name' => $this->model->id . '_{TYPE}.' . $this->image->extension,
            'image_dir' => $this->getImageDir(),
        ];

        $this->model->image = json_encode($attributes);
        $this->model->save();
    }

    public function createPreviewImage(): void
    {
        Image::thumbnail($this->getOriginImagePath(), 100, 100)->save($this->getPreviewImagePath(), ['quality' => 80]);
    }
}