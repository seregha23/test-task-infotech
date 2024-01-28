<?php /** @noinspection PhpUnused */

namespace app\models\forms;

use app\helpers\managers\MailManager;
use app\services\UsersService;
use app\models\User;
use yii\base\Model;

class SignupForm extends Model
{

    public string $login = '';
    public string $email = '';
    public string $username = '';
    public string $password = '';

    public function rules(): array
    {

        return [
            [['login', 'email', 'username', 'password'], 'required'],
            [['email', 'login', 'username'], 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'targetAttribute' => ['email',], 'message' => 'Этот email уже занят'],
            ['login', 'unique', 'targetClass' => '\app\models\User', 'targetAttribute' => ['login',], 'message' => 'Этот логин уже занят'],
            [['login', 'username'], 'string', 'min' => 1, 'max' => 32],
            ['password', 'string', 'min' => 6],
        ];
    }




    public function attributeLabels(): array
    {
        return [
            'login'    => 'Логин',
            'username' => 'Имя',
            'email'    => 'email',
            'password' => 'Пароль',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($sendEmail = true): ?User
    {
        $user = UsersService::createUser($this->attributes);
        if ($user && $sendEmail) {
            MailManager::sendToUser($user->email,'Регистрация', 'Вы успешно зарегистрированы');
        }
        return $user;
    }
}