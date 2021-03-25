<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactShops */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-shops-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'workingdays')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weekend')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tel1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
<p>  Узнать координаты можно <a target="_blank" href="https://yandex.ru/map-constructor/location-tool/"><i>тут - Определение координат </i></a> </p>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<hr>

  <?=  Html::img('/backend/web/img/for-map.png', ['class'=>'img-backend']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
