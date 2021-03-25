<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\Menu;

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

    <?php
    NavBar::begin([
        'brandLabel' => 'Админ панель',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
          'class' => 'navbar-inverse navbar-fixed-left',
          'id' => 'left_main_menu',
        ],
    ]);


    // Меню
    if (!\Yii::$app->user->isGuest && Yii::$app->getUser()->identity->role == 10) {
        $menuItems2 = [
          //  ['label' => 'Заказы', 'items' => [
                ['label' => 'Выделенный транспорт машина', 'url' => ['/dedicated-car/index']],
                ['label' => 'Выделенный транспорт фура', 'url' => ['/dedicated-truck/index']],
                ['label' => 'Сборный груз одно место', 'url' => ['/general-one-place/index']],
                ['label' => 'Сборный груз несколько мест', 'url' => ['/general-many-places/index']],
                ['label' => 'Сборный груз письмо', 'url' => ['/general-letter/index']],
        //    ]],
              ['label' => 'Тарифы', 'url' => ['/rate/index']],
        //    ['label' => 'Обращения', 'items' => [
                ['label' => 'Запросы документов', 'url' => ['/document-request/index']],
                ['label' => 'Обратая связь', 'url' => ['/feedback-request/index']],
        //    ]],
        //    ['label' => 'Адреса', 'items' => [
                ['label' => 'Юридические лица', 'url' => ['/entity-address/index']],
                ['label' => 'Физические лица', 'url' => ['/individual-address/index']],
                ['label' => 'Правовые формы', 'url' => ['/legal-form/index']],
// ]],
            ['label' => 'Документы', 'url' => ['/documents/index']],
            ['label' => 'Пользователи', 'url' => ['/user/index']],
            ['label' => 'Статьи', 'url' => ['/article/index']],
            ['label' => 'Новости', 'url' => ['/news/index']],
            ['label' => 'Контакты', 'url' => ['/contact/index']],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left', 'id' =>'admin_menu_left'],
            'items' => $menuItems2,
        ]);
    }



    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

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
