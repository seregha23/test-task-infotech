<?php

/* @var $this View */
/* @var $book Book */

use app\models\Book;
use yii\web\View;
?>

<div class="row">
    <div class="form-group">
        <a href="<?= url(['books/edit-book', 'idBook' => $book->id]) ?>" data-book_id="<?= $book->id ?>" class="btn btn-info">Редактировать книгу</a>
        <a href="javascript:void(0)" data-book_id="<?= $book->id ?>" class="btn btn-danger remove-book-js">Удалить книгу</a>
    </div>
    <div class="col-lg-12 mb-3">
        <h2><?= $book->title ?></h2>
        <p><?= $book->description ?></p>
    </div>
</div>
