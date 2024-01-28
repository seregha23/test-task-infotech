<?php /** @noinspection PhpUnused */

namespace app\models\forms;

use app\models\Subscriber;
use yii\base\Model;

class SubscriberCreateForm extends Model
{

    public string $email = '';

    public function rules(): array
    {
        return [
            [['email',], 'required'],
            [['email',], 'email'],
        ];
    }


    public function execute(): void
    {
        $subscriber = new Subscriber();
        $subscriber->email = $this->email;
        $subscriber->save();
    }
}
