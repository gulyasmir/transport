<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TextForPageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="text-for-page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'page') ?>

    <?= $form->field($model, 'name_page') ?>

    <?= $form->field($model, 'title_text') ?>

    <?= $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'title_seo') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
