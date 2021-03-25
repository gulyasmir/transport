<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    
    <?php
        $model->hidden_password = $model->password_hash;
        if ($model->password_hash) {
            $model->password_hash = '';
        }
    ?>
    <?= $form->field($model, 'password_hash')->textInput() ?>
    <?= $form->field($model, 'hidden_password')->hiddenInput() ?>
    
    <?=
        $form->field($model, 'role')->dropDownList(\Yii::$app->params['role']);
    ?>
    
    <?= $form->field($model, 'email')->textInput() ?>
    
    <?= $form->field($model, 'name')->textInput() ?>
    
    <?= $form->field($model, 'surname')->textInput() ?>
    
    <?= $form->field($model, 'patronymic')->textInput() ?>
    
    <?= $form->field($model, 'phone')->textInput() ?>
    
    <?= $form->field($model, 'inn')->textInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
