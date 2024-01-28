<?php

/* @var $this View */
/** @var SubscriberCreateForm $subscriberCreateForm */

use app\models\forms\SubscriberCreateForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>


<div class="row">
    <h2>Подписка</h2>
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'subscribe-form-js'],
            'action' => url(['site/ajax-send-subscribe-form']),
        ]); ?>
        <?= $form->field($subscriberCreateForm, 'email')->textInput(['autofocus' => true]) ?>


        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
