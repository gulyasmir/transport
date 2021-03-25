<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FeedbackRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'status')->dropDownList(\Yii::$app->params['requests_status']);
    ?>
    
    <?= $form->field($model, 'response')->textarea(['rows' => 6, 'readonly' => ($model->status == 1) ? false : true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Ответить', ['class' => 'btn btn-success']) ?>
    </div>
    
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6, 'readonly' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    
    <?php ActiveForm::end(); ?>

</div>
