<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace app\models\forms\book;

use app\models\Author;
use app\models\User;
use app\services\BooksService;

class BookEditForm extends AbstractBookForm
{

    public ?User $user = null;

    public function rules(): array
    {
        return [
            [['title'], 'required'],
            ['title', 'string', 'min' => 1, 'max' => '255'],
            ['description', 'string', 'min' => 1, 'max' => '4096'],
            ['authorNames', 'validateAuthors'],
        ];
    }

    public function getStoredAuthorNames(): array
    {
        /** @var $author Author  */
        $result = [];
        foreach ($this->book->authors as $author) {
            $result[$author->id] = $author->first_name . ' ' . $author->surname;
        }
        return $result;
    }


    public function execute(): bool
    {
        $this->book->title       = $this->title;
        $this->book->description = $this->description;

        BooksService::saveBooksToAuthors($this->authorIds, $this->book);

        return $this->book->save();
    }
}