<?php

namespace app\models;

use app\models\scopes\BaseQuery;
use app\models\traits\ImageTrait;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 *
 * @property int $id [int]
 * @property string $title [varchar(255)]
 * @property string $slug [varchar(255)]
 * @property int $year [int]
 * @property string $description
 * @property string $isbn [varchar(13)]
 * @property string $image [varchar(255)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 * @property int $status_id [smallint]
 * @property int $is_deleted [smallint]
 *
 * @property-read Author[] $authors
 *
 */class Book extends Base
{
    use ImageTrait;

    public static function tableName(): string
    {
        return '{{%books}}';
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
            ],
        ]);
    }

    public function getBooksToAuthors(): ActiveQuery {
        return $this->hasMany(BookToAuthor::class, ['book_id' => 'id']);
    }

    public function getAuthors(): ActiveQuery {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->via('booksToAuthors');
    }

    public function getUrl(): string
    {
        return '/books/' . $this->slug;
    }

    public function getAuthorNames(): array
    {
        $authorNames = [];
        foreach ($this->authors as $author) {
            $authorNames[$author->id] = $author->first_name . ' ' . $author->surname;
        }
        return $authorNames;
    }

    public function getAuthorIds(): array
    {
        $authorIds = [];
        foreach ($this->authors as $author) {
            $authorIds[] = $author->id;
        }
        return $authorIds;
    }


}