<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
//use yii\widgets\Menu;
use yii\widgets\Pjax;
/*
use common\models\DedicatedTransportCar;


if(\Yii::$app->request->isPjax){
    $model = DedicatedTransportCar::find()->all();
    $is_dedicated_car = count($model);
  //  echo "htpekmnfn".$new_count;
      return $is_dedicated_car;
  }
*/




AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
  <nav id="left_main_menu" class="navbar-inverse navbar-fixed-left navbar">

    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#left_main_menu-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button><a class="navbar-brand" href="/admin/">Админ панель</a>
      </div>
      <div id="left_main_menu-collapse" class="collapse navbar-collapse">

      <?php      if (Yii::$app->user->isGuest) {  ?>
        <div>
<ul id="login_button" class="navbar-nav nav"><li class="active"><a href="/backend/web/index.php?r=site%2Flogin">Войти</a></li></ul>

</div>
      <?php }  else { ?>
        <ul id="w1" class="navbar-nav navbar-left nav">
            <li class="attention" id="dedicated-car">
              <a href="/admin/dedicated-car/index">Выделенный транспорт машина
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="dedicated-truck">
              <a href="/admin/dedicated-truck/index">Выделенный транспорт фура
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="general-one-place">
              <a href="/admin/general-one-place/index">Сборный груз одно место
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="general-many-places">
              <a href="/admin/general-many-places/index">Сборный груз несколько мест
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="general-letter">
              <a href="/admin/general-letter/index">Сборный груз письмо
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="document-request">
              <a href="/admin/document-request/index">Запросы документов
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="feedback-request">
              <a href="/admin/feedback-request/index">Обратая связь
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="documents">
              <a href="/admin/documents/index">Документы
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>
              <li class="attention" id="user">
              <a href="/admin/user/index">Пользователи
                <img src="/backend/web/img/attention.gif" alt="attention"/>
              </a>
            </li>

            <li><a href="/admin/entity-address/index">Юридические лица</a></li>
            <li><a href="/admin/individual-address/index">Физические лица</a></li>
            <li><a href="/admin/rate/index">Тарифы</a></li>
            <li><a href="/admin/legal-form/index">Правовые формы</a></li>
            <li><a href="/admin/article/index">Статьи</a></li>
            <li><a href="/admin/news/index">Новости</a></li>
            <li><a href="/admin/contact/index">Контакты</a></li>
            <li><a href="/admin/contact-shops/index">Пункты выдачи</a></li>

            <li><a href="/admin/text-for-page/index">Тексты для страниц сайта </a></li>
            <li><a href="/admin/lk-page/index">Текст для Главной страницы ЛК</a></li>
            <li><a href="/admin/lk-change/index">Текст и образец заявления для страниц Изменить данные заказа</a></li>


        </ul>

        <ul id="w2" class="navbar-nav navbar-right nav">
          <li>
            <form action="/admin/admin/logout" method="post">
                <input type="hidden" name="_csrf-backend" value="Dk55KaJCFcCz64rRtj_bdyKoUbz2bzpLxcLz-A4p3bdhJ1R46nN88dTe5ZnYbekdU5wb88M3Cy2fs6mXfWzs6A==">
                <button type="submit" class="btn btn-link logout">Выйти (admin)</button>
            </form>
          </li>
        </ul>

          <?php }  ?>
      </div>
    </div>
</nav>
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode('Админ панель') ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
