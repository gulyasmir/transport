<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model common\models\TextForPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="text-for-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_text')->textarea(['rows' => 6]) ?>

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

    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
