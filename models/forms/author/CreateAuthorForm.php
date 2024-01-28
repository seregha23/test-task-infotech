<?php /** @noinspection PhpUnused */

namespace app\models\forms\author;

use app\models\Author;
use yii\base\Model;

class CreateAuthorForm extends Model
{
    public string $firstName = '';
    public string $surname = '';
    public ?Author $author = null;



    public function rules(): array
    {
        return [
            [['firstName', 'surname' ], 'required'],
            ['firstName', 'string', 'min' => 1, 'max' => '25'],
            ['surname', 'string', 'min' => 1, 'max' => '50'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'firstName' => 'Имя',
            'surname' => 'Фамилия',
        ];
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function execute(): bool
    {
        $this->author = new Author();
        $this->author->first_name = $this->firstName;
        $this->author->surname = $this->surname;
        return $this->author->save();
    }
}