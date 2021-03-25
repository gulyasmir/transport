<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EntityAddressSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'entity_address_id') ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'legal_form_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'inn') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
