<?php

namespace app\helpers\managers;

class MailManager
{
    public static function sendToUser(string $to, string $subject, string $body): bool
    {
        $mailer = app()->mailer;

        $message = $mailer->compose()
            ->setTo($to)
            ->setFrom('yii-app@mail.ru')
            ->setSubject($subject)
            ->setTextBody($body);

        return $message->send();
    }

}