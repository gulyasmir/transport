<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LkChange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lk-change-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_page')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

  <?= $form->field($model, 'filepdf1')->fileInput()->label('Образец заявления:') ?>
    <?php
      if(isset($model->pdf) && file_exists(Yii::getAlias('@webroot', $model->pdf)))
      {
        $basename_pdf = basename($model->pdf);
        //  echo   Html::tag('p', Html::encode('1) '.$basename_pdf), ['class' => 'pdf']);
           echo $form->field($model,'del_filepdf1')->checkBox(['class'=>'span-1']);
      }
    ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
