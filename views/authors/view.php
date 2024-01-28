<?php

/* @var $this View */
/* @var $author Author */

use app\models\Author;
use yii\web\View;
?>

<div class="row">
    <div class="form-group">
        <a href="javascript:void(0)" data-book_id="<?= $author->id ?>" class="btn btn-danger remove-author-js">Удалить автора</a>
    </div>
    <div class="col-lg-12 mb-3">
        <h2><?= $author->first_name ?></h2>
        <p><?= $author->surname ?></p>
    </div>
</div>
