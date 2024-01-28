<?php

namespace app\models\traits;

use yii\helpers\BaseStringHelper;

trait ImageTrait {

    public function getOriginImagePath(): string
    {
        return $this->getImageDir() . '/' . $this->getOriginImageName();
    }

    public function getPreviewImagePath(): string
    {
        return $this->getImageDir() . '/' . $this->getPreviewImageName();
    }

    public function getOriginImageName(): string
    {
        $imageName = json_decode($this->image, true)['image_name'] ?? '';
        return str_replace('{TYPE}', 'origin', $imageName);
    }

    public function getPreviewImageName(): string
    {
        $imageName = json_decode($this->image, true)['image_name'] ?? '';
        return str_replace('{TYPE}', 'preview', $imageName);
    }


    public function getImageDir(): string
    {
        return  app()->params['staticUrl'] .  'images/' . mb_strtolower(BaseStringHelper::basename(get_class()));
    }
}