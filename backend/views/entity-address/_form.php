<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\LegalForm;

/* @var $this yii\web\View */
/* @var $model common\models\EntityAddress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entity-address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'legal_form_id')->dropDownList(ArrayHelper::map(LegalForm::find()->all(), 'legal_form_id', 'name'));
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kpp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
