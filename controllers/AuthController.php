<?php
/** @noinspection PhpUnused */

namespace app\controllers;

use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;

class AuthController extends BaseController
{

    public function behaviors(): array {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup', 'logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        if (!app()->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            app()->session->setFlash('success', ['value' => 'Вы вошли успешно']);
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup(): Response|string
    {
        if (!app()->user->isGuest) {
            return $this->redirect('/');
        }

        $signupForm = new SignupForm();
        if (request()->isPost) {
            if ($signupForm->load(request()->post()) && $signupForm->validate() && $user = $signupForm->signup()) {
                app()->user->login($user);
                app()->session->setFlash('success', ['value' => 'Регистрация прошла успешно', 'timer' => 2000]);

                return $this->redirect('/');
            } else {
                app()->session->setFlash('errors', ['value' => 'Регистрация не прошла успешно', 'timer' => 2000]);
            }
        }

        return $this->render('signup', [
            'signupForm' => $signupForm
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
