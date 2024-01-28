<?php

/* @var $this View */

/* @var $signupForm SignupForm */

use app\models\forms\SignupForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'action' => url(['auth/signup']),
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($signupForm, 'login',['inputOptions' => ['placeholder' => 'Логин'] ])->label(false)->textInput() ?>
            <?= $form->field($signupForm, 'username', ['inputOptions' => ['placeholder' => 'Имя'] ])->label(false)->textInput() ?>
            <?= $form->field($signupForm, 'email', ['inputOptions' => ['placeholder' => 'email'] ])->label(false)->textInput(['type' => 'email']) ?>
            <?= $form->field($signupForm, 'password',  ['inputOptions' => ['placeholder' => 'Пароль']])->label(false)->passwordInput() ?>

            <div class="form-group">
                <div><?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?></div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>



