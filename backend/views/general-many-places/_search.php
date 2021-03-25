<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralCargoManyPlacesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="general-cargo-many-places-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'gc_many_places_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'biggest_length') ?>

    <?= $form->field($model, 'biggest_width') ?>

    <?= $form->field($model, 'biggest_height') ?>

    <?php // echo $form->field($model, 'place_quantity') ?>

    <?php // echo $form->field($model, 'overall_volume') ?>

    <?php // echo $form->field($model, 'overall_weight') ?>

    <?php // echo $form->field($model, 'cargo_params') ?>

    <?php // echo $form->field($model, 'hazard_class') ?>

    <?php // echo $form->field($model, 'declared_price') ?>

    <?php // echo $form->field($model, 'from') ?>

    <?php // echo $form->field($model, 'to') ?>

    <?php // echo $form->field($model, 'city_pick_up') ?>

    <?php // echo $form->field($model, 'city_delivery') ?>

    <?php // echo $form->field($model, 'pick_up_date') ?>

    <?php // echo $form->field($model, 'from_address_loading') ?>

    <?php // echo $form->field($model, 'loading_operations') ?>

    <?php // echo $form->field($model, 'territory_entry') ?>

    <?php // echo $form->field($model, 'is_draft') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
