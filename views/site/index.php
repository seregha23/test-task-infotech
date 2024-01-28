<?php

/** @var yii\web\View $this */
/** @var SubscriberCreateForm $subscriberCreateForm */

use app\models\forms\SubscriberCreateForm;
use app\widgets\BooksWidget;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php if (!isGuest()) { ?>
        <p><a class="btn btn-lg btn-success" href="<?= url(['books/create-book']) ?>">Создать книгу</a></p>
        <p><a class="btn btn-lg btn-success" href="<?= url(['authors/create-author']) ?>">Добавить автора</a></p>
    <?php }?>
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Каталог книг</h1>
    </div>

    <div class="body-content">
        <?= BooksWidget::widget() ?>
    </div>

    <?= $this->render('_send_subscribe_form', ['subscriberCreateForm' => $subscriberCreateForm]) ?>
</div>
