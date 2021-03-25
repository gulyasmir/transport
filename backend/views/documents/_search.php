<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DocumentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'document_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'uploader') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
