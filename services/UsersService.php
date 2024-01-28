<?php

namespace app\services;

use app\models\User;

class UsersService
{
    public static function createUser(array $data): ?User
    {
        $user = new User();
        $user->setAttributes($data);
        $user->setPassword($data['password']);
        $user->generateAuthKey();
        if ($user->save()) {
            return $user;
        } else {
            return null;
        }
    }

}