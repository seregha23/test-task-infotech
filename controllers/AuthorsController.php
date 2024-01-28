<?php

namespace app\controllers;

use app\models\Author;
use app\models\forms\author\CreateAuthorForm;
use app\models\forms\author\RemoveAuthorForm;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class
AuthorsController extends BaseController
{

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create-author', 'ajax-remove-author'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create-author', 'ajax-remove-author'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionView(string $slug): string
    {
        $author = Author::find()->published()->andWhere(['slug' => $slug])->one();
        if (!$author) {
            throw new NotFoundHttpException();
        }

        return $this->render('//authors/view', [
            'author'           => $author,
            'removeAuthorForm' => new RemoveAuthorForm(),
        ]);
    }


    public function actionCreateAuthor(): Response|string
    {
        $isSuccessful = false;
        $createAuthorForm = new CreateAuthorForm();
        if (request()->isPost) {
            if ($createAuthorForm->load(request()->post()) && $createAuthorForm->validate()) {
                $isSuccessful = $createAuthorForm->execute();
                if ($isSuccessful) {
                    app()->session->setFlash('success', ['value' => 'Автор успешно создан']);
                    return $this->redirect(['authors/view', 'slug' => $createAuthorForm->getAuthor()->slug]);
                }
            }
            if (!$isSuccessful) {
                app()->session->setFlash('error', ['value' => 'Ошибка.Книга не сохранена']);
            }
        }


        return $this->render('//authors/create-author', [
            'createAuthorForm' => $createAuthorForm
        ]);
    }

    public function actionAjaxRemoveAuthor(): Response|string
    {
        $isSuccessful   = false;
        $data           = ['RemoveAuthorForm' => request()->post()];
        $removeAuthorForm = new RemoveAuthorForm();

        if ($removeAuthorForm->load($data) && $removeAuthorForm->validate()) {
            $isSuccessful = $removeAuthorForm->execute();
        }

        if ($isSuccessful) {
            app()->session->setFlash('success', ['value' => 'Автор успешно удален']);
            return $this->redirect('/');
        } else {
            app()->session->setFlash('error', ['value' => 'Ошибка.Автор не удален']);
            return $this->redirect(['authors/view', 'id' => $removeAuthorForm->authorId]);
        }
    }
}