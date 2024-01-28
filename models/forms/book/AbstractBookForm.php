<?php

namespace app\models\forms\book;

use app\models\Author;
use app\models\Book;
use yii\base\Model;

class AbstractBookForm extends Model
{
    public ?string $title = '';
    public ?int $year = 0;
    public ?string $description = '';
    public ?string $isbn = '';
    public mixed $authorNames = [];
    public array $authorIds = [];

    public ?Book $book = null;

    public function beforeValidate(): bool
    {
        $this->authorNames = is_array($this->authorNames) ? $this->authorNames : [];
        return parent::beforeValidate();
    }

    public function validateAuthors(): void
    {
        $this->authorNames = array_filter(($this->authorNames));

        // собрать только тех авторов, которые есть в базе
        $this->authorIds = Author::find()->select('id')->published()->andWhere(['in', 'id', $this->authorNames])->asArray()->column();
        //        $this->authorIds = Author::find()->select(new Expression('CONCAT(first_name, " ", surname) AS full_name'))->published()->andWhere(['in', 'id', array_keys($this->authorNames)])->indexBy('id')->asArray()->column();
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Название',
            'mainPhoto' => 'Обложка',
            'description' => 'Описание',
            'isbn' => 'isbn',
            'year' => 'Год издания',
        ];
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }
}