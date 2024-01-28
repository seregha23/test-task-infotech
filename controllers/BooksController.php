<?php

namespace app\controllers;

use app\models\Book;
use app\models\forms\book\BookCreateForm;
use app\models\forms\book\BookEditForm;
use app\models\forms\book\BookRemoveForm;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BooksController extends BaseController
{

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create-book', 'edit-book', 'ajax-remove-book'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create-book', 'edit-book', 'ajax-remove-book'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionView(string $slug): Response|string
    {
        $book = Book::find()->published()->andWhere(['slug' => $slug])->one();
        if (!$book) {
            throw new NotFoundHttpException();
        }

        return $this->render('//books/view', [
            'book'           => $book,
            'bookRemoveForm' => new BookRemoveForm(),
        ]);
    }


    public function actionCreateBook(): Response|string
    {
        $isSuccessful = false;
        $bookCreateForm = new BookCreateForm();
        if (request()->isPost) {
            if ($bookCreateForm->load(request()->post()) && $bookCreateForm->validate()) {
                $isSuccessful = $bookCreateForm->execute();
                if ($isSuccessful) {
                    app()->session->setFlash('success', ['value' => 'Книга успешно сохранена']);
                    return $this->redirect(['books/view', 'slug' => $bookCreateForm->getBook()->slug]);
                }
            }
            if (!$isSuccessful) {
                app()->session->setFlash('error', ['value' => 'Ошибка.Книга не сохранена']);
            }
        }


        return $this->render('//books/create-book', [
            'bookCreateForm' => $bookCreateForm
        ]);
    }

    public function actionEditBook(int $idBook): Response|string
    {
        $isSuccessful = false;
        $book = Book::find()->published()->andWhere(['id' => $idBook])->one();
        if (!$book) {
            throw new NotFoundHttpException();
        }

        $bookEditForm = new BookEditForm([
            'title' => $book->title,
            'year' => $book->year ,
            'description' => $book->description,
            'isbn' => $book->isbn,
            'book' => $book,
        ]);
        if (request()->isPost) {
            if ($bookEditForm->load(request()->post()) && $bookEditForm->validate()) {
                $isSuccessful = $bookEditForm->execute();
                if ($isSuccessful) {
                    app()->session->setFlash('success', ['value' => 'Книга успешно изменена']);
                    return $this->redirect(['books/view', 'slug' => $bookEditForm->getBook()->slug]);
                }
            }
            if (!$isSuccessful) {
                app()->session->setFlash('error', ['value' => 'Ошибка.Книга не изменена']);
            }
        }

        return $this->render('//books/edit-book', [
            'bookEditForm' => $bookEditForm
        ]);

    }

    public function actionAjaxRemoveBook(): Response|string
    {
        $isSuccessful   = false;
        $data           = ['BookRemoveForm' => request()->post()];
        $bookRemoveForm = new BookRemoveForm();

        if ($bookRemoveForm->load($data) && $bookRemoveForm->validate()) {
            $isSuccessful = $bookRemoveForm->execute();
        }

        if ($isSuccessful) {
            app()->session->setFlash('success', ['value' => 'Книга успешно удалена']);
            return $this->redirect('/');
        } else {
            app()->session->setFlash('error', ['value' => 'Ошибка.Книга не удалена']);
            return $this->redirect(['books/view', 'id' => $bookRemoveForm->bookId]);
        }
    }
}