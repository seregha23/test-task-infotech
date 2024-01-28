<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

/**
 *
 * @property int $id [int]
 * @property int $book_id [int]
 * @property int $author_id [int]
 * @property string $created_at [datetime]
 */
class BookToAuthor extends ActiveRecord
{

    public static function tableName(): string
    {
        return '{{%books_to_authors}}';
    }

    public function behaviors(): array {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
}