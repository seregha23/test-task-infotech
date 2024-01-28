<?php
/** @noinspection PhpUnused */

namespace app\models\forms\author;

use app\models\Author;
use app\models\Base;
use yii\base\Model;

class RemoveAuthorForm extends Model {
    public int $authorId = 0;
    public ?Author $author = null;


    public function rules(): array {
        return [
            [['authorId'], 'required'],
            ['authorId', 'customValidateAuthor'],
        ];
    }

    public function customValidateAuthor(): void {
        $this->author = Author::find()->published()->andWhere(['id' => $this->authorId])->one();
        if (!$this->author) {
            $this->addError('authorId', 'автор не найден');
        }
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function execute(): bool
    {
        $this->author->status_id = Base::STATUS_DRAFT;
        $this->author->is_deleted = true;
        return $this->author->save();
    }
}