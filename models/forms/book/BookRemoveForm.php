<?php

namespace app\models\forms\book;

use app\models\Base;
use app\models\Book;
use yii\base\Model;

class BookRemoveForm extends Model
{
    public int $bookId = 0;

    protected ?Book $book = null;

    public function rules(): array
    {
        return [
            [['bookId'], 'required'],
            ['bookId', 'customValidateBook'],
        ];
    }

    public function customValidateBook(): void
    {
        $this->book = Book::find()->published()->andWhere(['id' => $this->bookId])->one();
        if (!$this->book) {
            $this->addError('bookId', 'книга не найдена');
        }
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function execute(): bool
    {
        $this->book->status_id = Base::STATUS_DRAFT;
        $this->book->is_deleted = true;
        return $this->book->save();
    }
}