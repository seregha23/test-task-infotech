<?php

/* @var $this View */
/* @var $bookCreateForm BookCreateForm */

use app\models\Author;
use app\models\forms\book\BookCreateForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'action' => url(['books/create-book']),
        ]); ?>

        <?= $form->field($bookCreateForm, 'title')->textInput(['autofocus' => true]) ?>

        <?= $form->field($bookCreateForm, 'year') ?>

        <?= $form->field($bookCreateForm, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($bookCreateForm, 'mainPhoto')->widget(FileInput::class, [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'dropZoneTitle' => 'Перетащите файлы сюда',
                'maxFileCount' => 1,
                'browseLabel' => 'Выбрать изображения',
                'browseClass' => 'btn btn-primary btn-upload-photo',
                'browseIcon' => '<i class="fas fa-camera"></i> ',
            ],
        ])->label(false); ?>

        <?= $form->field($bookCreateForm, 'authorNames')->widget(Select2::class, [
            'data' => Author::getAllPublishedAuthorNames(),
            'language' => 'ru',
            'theme' => 'bootstrap',
            'options' => [
                'value'       => [],
                'multiple'    => true,
                'tags'        => true,
                'placeholder' => 'Авторы...',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'tags'       => false,
            ],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
