<?php

/* @var $this View */
/* @var $bookEditForm BookEditForm */

use app\models\Author;
use app\models\forms\book\BookEditForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'action' => url(['books/edit-book', 'idBook' => $bookEditForm->getBook()->id]),
        ]); ?>

        <?= $form->field($bookEditForm, 'title')->textInput(['autofocus' => true]) ?>

        <?= $form->field($bookEditForm, 'year') ?>

        <?= $form->field($bookEditForm, 'description')->textarea(['rows' => 6]) ?>



        <?= $form->field($bookEditForm, 'authorNames')->widget(Select2::class, [
            'data' => Author::getAllPublishedAuthorNames(),
            'language' => 'ru',
            'theme' => 'bootstrap',
            'options' => [
                'value'       => $bookEditForm->getBook()->getAuthorIds(),
                'multiple'    => true,
                'tags'        => true,
                'placeholder' => 'Авторы...',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'tags'       => false,
            ],
        ]); ?>

        <?php
//                var_dump(Author::getAllPublishedAuthorNames());
//                var_dump($bookEditForm->getStoredAuthorNames());
//                var_dump($bookEditForm->authorNames);
//                die();

        ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
