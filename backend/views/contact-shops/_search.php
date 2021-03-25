<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactShopsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-shops-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'location') ?>

    <?= $form->field($model, 'workingdays') ?>

    <?= $form->field($model, 'weekend') ?>

    <?php // echo $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'tel1') ?>

    <?php // echo $form->field($model, 'tel2') ?>

    <?php // echo $form->field($model, 'mail') ?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
