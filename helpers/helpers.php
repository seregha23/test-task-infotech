<?php

use yii\helpers\Url;
use yii\web\Response;
use yii\web\Session;

function request() {
    return Yii::$app->request;
}

function response(): Response {
    return Yii::$app->response;
}

function session(): Session {
    return Yii::$app->session;
}

function app() {
    return Yii::$app;
}

function url($params, $scheme = false): string {
    return Url::to($params, $scheme);
}


function isGuest(): bool {
    return app()->user->getIsGuest();
}

