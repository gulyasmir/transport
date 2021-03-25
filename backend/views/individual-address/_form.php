<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="individual-address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'identification')->dropDownList(\Yii::$app->params['identification']);
    ?>

    <?= $form->field($model, 'identification_series')->textInput() ?>

    <?= $form->field($model, 'identification_number')->textInput() ?>

    <?= $form->field($model, 'identification_uvd')->textInput() ?>

    <?= $form->field($model, 'identification_date')->textInput() ?>

    <?= $form->field($model, 'aaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
