<?php

/* @var $this View */
/* @var $books Book[] */
/* @var $pagination Pagination */

use app\models\Book;
use yii\data\Pagination;
use yii\web\View;
use yii\widgets\LinkPager;

?>

<div class="row">
    <?php foreach ($books as $book) { ?>
        <div class="col-lg-4 mb-3">
            <h2><?= $book->title ?></h2>

            <p><?= $book->description ?></p>

            <img src="<?= $book->getPreviewImagePath() ?>" alt="">
            <p><a class="btn btn-outline-secondary" href="<?= $book->getUrl() ?>">Перейти</a></p>
        </div>
    <?php } ?>

    <?= LinkPager::widget([
        'pagination' => $pagination,
    ]) ?>
</div>
