<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="auth-section other-section">
    <div class="container">
        <div class="site-request-password-reset site-login">
            <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
            
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
        
                        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email'), 'autofocus' => true])->label(false) ?>
                        
                        <div class="reset">
                            Введите свой Email в поле выше. Вам будет отправлена ссылка на восстановление пароля.
                        </div>
                        
                        <div class="form-group">
                            <?= Html::submitButton('Восстановить', ['class' => 'btn btn-primary', 'id' => 'reset-button', 'name' => 'reset-button']) ?>
                        </div>
        
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
