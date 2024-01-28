<?php

/* @var $this View */
 /* @var $createAuthorForm CreateAuthorForm */

use app\models\forms\author\CreateAuthorForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin([
            'action' => url(['authors/create-author']),
        ]); ?>

        <?= $form->field($createAuthorForm, 'firstName')->textInput(['autofocus' => true]) ?>

        <?= $form->field($createAuthorForm, 'surname')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
