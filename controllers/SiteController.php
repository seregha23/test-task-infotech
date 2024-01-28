<?php

namespace app\controllers;

use app\models\forms\SubscriberCreateForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['subscriberCreateForm' => new SubscriberCreateForm()]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAjaxSendSubscribeForm(): array
    {
        $isSuccessful = false;
        $subscriberCreateForm = new SubscriberCreateForm();
        if ($subscriberCreateForm->load(request()->post()) && $subscriberCreateForm->validate()) {
            $subscriberCreateForm->execute();
            $isSuccessful = true;
        }

        $response = [
            'is_successful' => $isSuccessful,
            'notification' => [
                'style'    => $isSuccessful ? 'success' : 'error',
                'message'  => $isSuccessful ? 'Подписка оформлена' : 'Ошибка при оформлении подписки',
            ],
            'errors' => $subscriberCreateForm->getErrors()
        ];

        app()->response->format = Response::FORMAT_JSON;
        return $response;
    }
}
