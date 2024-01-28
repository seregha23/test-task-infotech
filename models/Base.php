<?php

namespace app\models;

use app\models\scopes\BaseQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\helpers\StringHelper;

abstract class Base extends ActiveRecord
{
    public const STATUS_PUBLISHED = 1;
    public const STATUS_DRAFT = 0;

    public const SCOPES_PATH = '\scopes\\';

    public static array $statuses = [
        Base::STATUS_DRAFT     => 'Ожидание',
        Base::STATUS_PUBLISHED => 'Опубликовано',
    ];

    public function behaviors(): array {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function find(): BaseQuery {
        $queryClass = StringHelper::basename(static::class) . 'Query';
        $QueryClass = 'common\models' . self::SCOPES_PATH.$queryClass;

        if (class_exists($QueryClass)) {
            return new $QueryClass(static::class);
        }
        return new BaseQuery(static::class);
    }
}
