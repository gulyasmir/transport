<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DedicatedTransportCarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dedicated-transport-car-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'dt_car_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'load_capacity') ?>

    <?= $form->field($model, 'cargo_params') ?>

    <?= $form->field($model, 'hazard_class') ?>

    <?php // echo $form->field($model, 'declared_price') ?>

    <?php // echo $form->field($model, 'from') ?>

    <?php // echo $form->field($model, 'to') ?>

    <?php // echo $form->field($model, 'city_pick_up') ?>

    <?php // echo $form->field($model, 'city_delivery') ?>

    <?php // echo $form->field($model, 'pick_up_date') ?>

    <?php // echo $form->field($model, 'from_address_loading') ?>

    <?php // echo $form->field($model, 'loading_operations') ?>

    <?php // echo $form->field($model, 'territory_entry') ?>

    <?php // echo $form->field($model, 'filling') ?>

    <?php // echo $form->field($model, 'hard_package') ?>

    <?php // echo $form->field($model, 'pallet_transparent') ?>

    <?php // echo $form->field($model, 'pallet_black') ?>

    <?php // echo $form->field($model, 'tent_remove_to') ?>

    <?php // echo $form->field($model, 'tent_remove_from') ?>

    <?php // echo $form->field($model, 'pallet_board_pack') ?>

    <?php // echo $form->field($model, 'is_draft') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
