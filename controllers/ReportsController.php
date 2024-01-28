<?php

namespace app\controllers;

use app\models\Author;
use app\models\BookToAuthor;

class ReportsController extends BaseController
{

    public function actionTopAuthors(int $year): string
    {
        $authors = Author::find()
            ->published()
            ->select([Author::tableName() . '.*', 'COUNT(book_id) as books_count'])
            ->innerJoin(BookToAuthor::tableName(), Author::tableName() . '.id='.BookToAuthor::tableName() . '.author_id')
            ->where(['YEAR('. BookToAuthor::tableName() .  '.created_at)' => $year])
            ->groupBy('author_id')
            ->orderBy('books_count DESC')
            ->all();

        return $this->render('//reports/top-authors', [
            'authors' => $authors,
        ]);
    }
}