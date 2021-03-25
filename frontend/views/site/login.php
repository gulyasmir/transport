<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';

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
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true])->label(false) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

                        <?= $form->field($model, 'rememberMe', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox'])?>

                        <div class="reset">
                            Забыли свой пароль? Можете  <?= Html::a('восстановить его', ['site/request-password-reset']) ?>, <br />Если нет аккаунта <?= Html::a('зарегистрируйтесь', ['@web/registration']) ?>.
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'id' => 'login-button', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>


    </div>
</section>
