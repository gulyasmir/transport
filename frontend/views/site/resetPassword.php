<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Смена пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="auth-section other-section">
    <div class="container">
        <div class="site-reset-password site-login">
            <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
            
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                        
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'autofocus' => true])->label(false) ?>
                        
                        <div class="reset">
                            Введите новый пароль в поле выше.
                        </div>
                        
                        <div class="form-group">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'id' => 'reset-button', 'name' => 'reset-button']) ?>
                        </div>
                        
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

