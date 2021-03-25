<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
    
      <?php if (!empty($model->title)) {
      if (($model->title == 'Документальное подтверждение стоимости груза') OR ($model->title == 'Подробнее о классах опасности')) {
      echo " <p style = 'color:#f00'><i> Редактировать этот заголовок нельзя, т.к. на эту статью идет ссылка из расчета заказа. </i> </p>";
       echo " <p><b> Заголовок статьи  -  ".$model->title."</b></p>";
      } else {
      	echo  $form->field($model, 'title')->textInput(['maxlength' => true]);
      }
      }   else {
      	echo  $form->field($model, 'title')->textInput(['maxlength' => true]);
      } ?>
  
    
    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
            'options' => ['rows' => 6],
            'language' => 'ru',
            'clientOptions' => [
            'plugins' => [
                'advlist autolink lists link charmap hr preview pagebreak',
                'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                'save insertdatetime media table contextmenu template paste image responsivefilemanager filemanager',
            ],
            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager link image media',
            'external_filemanager_path' => '/backend/web/plugins/responsivefilemanager/filemanager/',
            'filemanager_title' => 'Responsive Filemanager',
            'external_plugins' => [
                'filemanager' => '/backend/web/plugins/responsivefilemanager/filemanager/plugin.min.js',
                'responsivefilemanager' => '/backend/web/plugins/responsivefilemanager/plugin.min.js',
            ], 
        ]
    ]);?>
    
    <div style="margin-bottom: 25px;margin-top: 25px;">
    <?php if(!empty($model->image)){
        echo Html::img(\Yii::$app->params['articles_http_path'].'/'.$model->image, $options = ['class' => 'img', 'style' => ['width' => '120px']]);
    } ?>
    <?= $form->field($model, 'file')->fileInput()->label('Изображение') ?>
    </div>
    
    <div style="margin-bottom: 30px;">
        <label class="control-label" for="date">Дата  публикации</label>
        <div>
        <?php
            if (!$model->date) {
                $model->date = date('d.m.Y', time());
            }
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'date',
                'language' => 'ru',
                'dateFormat' => 'dd.MM.yyyy',
            ]);
        ?>
        </div>
    </div>
    
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    
    <?=
        $form->field($model, 'view')->dropDownList(\Yii::$app->params['article_view']);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
