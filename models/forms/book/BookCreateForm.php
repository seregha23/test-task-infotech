<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace app\models\forms\book;

use app\models\Book;
use app\models\User;
use app\services\BooksService;
use app\services\ImagesService;
use yii\web\UploadedFile;

class BookCreateForm extends AbstractBookForm
{

    public $mainPhoto;

    public ?User $user = null;


    public function beforeValidate(): bool
    {
        $this->mainPhoto = UploadedFile::getInstance($this, 'mainPhoto');
        return parent::beforeValidate();
    }

    public function rules(): array
    {
        return [
            [['title', 'mainPhoto' ], 'required'],
            ['title', 'string', 'min' => 1, 'max' => '255'],
            ['description', 'string', 'min' => 1, 'max' => '4096'],
            ['mainPhoto', 'file', 'skipOnEmpty' => false, 'checkExtensionByMimeType' => false,  'extensions' => 'png, jpg'],
            ['authorNames', 'validateAuthors'],
        ];
    }

    public function execute(): bool
    {
        $this->book              = new Book();
        $this->book->title       = $this->title;
        $this->book->description = $this->description;

        if ($this->book->save()) {
            ImagesService::getInstance($this->book, $this->mainPhoto)->saveImage();

            if (!empty($this->authorIds)) {
                BooksService::saveBooksToAuthors($this->authorIds, $this->book);
            }
            return true;
        }
        return false;
    }
}