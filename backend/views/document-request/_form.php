<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocumentRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'status')->dropDownList(\Yii::$app->params['requests_status']);
    ?>

    <?= $form->field($model, 'response')->textarea(['rows' => 6, 'readonly' => ($model->status == 1) ? false : true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Ответить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
        if (isset($model->send_post)) {
            echo 'Отправить почтой: Да<br><br>';
        } else {
            echo 'Отправить почтой: Нет<br><br>';
        }
    ?>
      <?= $form->field($model, 'post_adress')->textarea(['rows' => 6, 'readonly' => true]) ?>
      
    <?php
        if (isset($model->send_email)) {
            echo 'Отпраивть на email: Да<br><br>';
        } else {
            echo 'Отпраивть на email: Нет<br><br>';
        }
    ?>

    <?= $form->field($model, 'date_from')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'date_to')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6, 'readonly' => true]) ?>


    <?php ActiveForm::end(); ?>

</div>
