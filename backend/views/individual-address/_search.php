<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IndividualAddressSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="individual-address-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'individual_address_id') ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'country') ?>

    <?= $form->field($model, 'identification') ?>

    <?php // echo $form->field($model, 'identification_series') ?>

    <?php // echo $form->field($model, 'identification_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
