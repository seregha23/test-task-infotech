<?php

/* @var $this View */
/* @var $authors Author[] */

use app\models\Author;
use yii\web\View;

?>
<table class="table">
    <thead>
    <tr>
        <th>Автор</th>
        <th>Количество книг</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($authors as $author) {  ?>
        <tr>
            <td><?= $author->getAuthorFullName() ?></td>
            <td><?= $author->getBooksCount() ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>