<?php

namespace app\models;

use app\models\traits\ImageTrait;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 *
 * @property int $id [int]
 * @property string $slug [varchar(25)]
 * @property string $first_name [varchar(25)]
 * @property string $surname [varchar(50)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 * @property int $status_id [smallint]
 * @property int $is_deleted [smallint]
 */
class Author extends Base
{
    use ImageTrait;

    public static function tableName(): string
    {
        return '{{%authors}}';
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => SluggableBehavior::class,
                'attribute' => ['first_name', 'surname'],
            ],
        ]);
    }

    public function getAuthorFullName(): string
    {
        return $this->first_name . ' ' . $this->surname;
    }

    public function getBooksCount(): string
    {
        /** TOD: перенести в authors.books_count */
        return BookToAuthor::find()->andWhere(['author_id' => $this->id])->count();
    }

    public function getUrl(): string
    {
        return '/books/' . $this->slug;
    }

    public static function getAllPublishedAuthorNames(): array
    {
        return Author::find()->select(new Expression('CONCAT(first_name, " ", surname) AS full_name'))->published()->indexBy('id')->asArray()->column();
    }

}