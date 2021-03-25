<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';

$this->title = $text_for_page->title_seo ;
$this->registerMetaTag([
  'name' => 'description',
  'content' => $text_for_page->description,
]);
$this->registerMetaTag([
'name' => 'keywords',
   'content' =>$text_for_page->keywords,
]);



$this->params['breadcrumbs'][] = $this->title;
?>

<section class="auth-section other-section">
    <div class="container">
        <div class="site-login">
            <h1 class="section-title"><?= Html::encode($this->title) ?></h1>

            <div class="row">
              <div class="col-lg-5">
                <div class="text_for_page ">
                  <h2><?=$text_for_page->title_text ?></h2>
                  <div class="text_for_page"><?=$text_for_page->text ?></div>
                </div>
              </div>
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true])->label(false) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

                        <?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => $model->getAttributeLabel('confirm_password')])->label(false) ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>

                        <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')])->label(false) ?>

                        <?= $form->field($model, 'surname')->textInput(['placeholder' => $model->getAttributeLabel('surname')])->label(false) ?>

                        <?= $form->field($model, 'patronymic')->textInput(['placeholder' => $model->getAttributeLabel('patronymic')])->label(false) ?>

                        <?= $form->field($model, 'phone')->textInput(['placeholder' => $model->getAttributeLabel('phone')])->label(false) ?>

                        <?= $form->field($model, 'inn')->textInput(['placeholder' => $model->getAttributeLabel('inn')])->label(false) ?>

                        <div class="reset">
                            Если уже есть аккаунт <?= Html::a('авторизуйтесь', ['@web/site/login']) ?>.
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'id' => 'signup-button', 'name' => 'signup-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
