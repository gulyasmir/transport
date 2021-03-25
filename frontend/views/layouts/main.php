<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;

use common\models\Article;

 $article_for_service = Article::find()->where(['view'=>'3'])->all();
 $article_for_customer = Article::find()->where(['view'=>'4'])->all();
 
AppAsset::register($this);

function translit($s) {
$s = (string) $s; 
$s = strip_tags($s); 
$s = str_replace(array("\n", "\r"), " ", $s); 
$s = preg_replace("/\s+/", ' ', $s); 
$s = trim($s);
$s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); 
$s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
$s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); 
$s = str_replace(" ", "", $s); 
$s = str_replace("-", "", $s); 
return $s; 
}

$right_tel = translit( \Yii::$app->controller->contacts->phone);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Favicon -->
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon-180x180.png">

    <!-- Adaptive  -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom Browsers Color Start -->
	<meta name="theme-color" content="#000">

	<!-- OG tags -->
	<meta property="og:title" content=">">
	<meta property="og:description" content="">
	<meta property="og:type" content="article">
	<meta property="og:image" content="http://mysite.com/img/preview.jpg" >
	<meta property="og:site_name" content="">

    <!-- Prefetch images -->
    <link rel="prefetch prerender" href="<?= Url::to('@web/img/calculator_hv.png') ?>">
    <link rel="prefetch prerender" href="<?= Url::to('@web/img/search-box_hv.png') ?>">
    <link rel="prefetch prerender" href="<?= Url::to('@web/img/info_hv.png') ?>">
    <link rel="prefetch prerender" href="<?= Url::to('@web/img/facebook-hover.png') ?>">
    <link rel="prefetch prerender" href="<?= Url::to('@web/img/instagram-hover.png') ?>">
    <link rel="prefetch prerender" href="<?= Url::to('@web/img/vk-hover.png') ?>">

    <script src="https://api-maps.yandex.ru/2.1/?apikey=7e0a7275-761b-440e-ac73-1b6a0744cf9f&lang=ru_RU" type="text/javascript">
    </script>
</head>
<body>
<?php $this->beginBody() ?>
	<div class="mobile-menu-wrap">
		<button class="mobile-close">
			<img src="<?= Url::to('@web/img/close.svg') ?>" alt="Закрыть">
		</button>
		<a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('site/index') ?>" class="mobile-logo">
			<img src="<?= Url::to('@web/img/logo.png') ?>" alt="Gulyasmir">
		</a>
		<a class="mob-area" href="<?= \Yii::$app->urlManager->createAbsoluteUrl('client/index') ?>">
			<img src="<?= Url::to('@web/img/user.svg') ?>" alt="">
			<p>Личный кабинет</p>
		</a>
		<a class="mob-cart" href="#">
			<img src="<?= Url::to('@web/img/delivery-truck.svg') ?>" alt="">
			<p>
				Заказать доставку
			</p>
		</a>
		<ul class="mobile-menu">
			<li>
				<a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('order/index') ?>">
					Рассчитать доставку
				</a>
			</li>
		<!--	<li>
				<a href="#catalog">
					Отследить груз
				</a>
			</li>-->
			<li>
				<a href="/site/contact">
					Представительства
				</a>
			</li>
		</ul>
		<div class="mobile-contacts">
			<div class="mobile-contacts__contact">
				<img src="<?= Url::to('@web/img/flags.svg') ?>" alt="" class="mobile-contacts__icon mobile-contacts__icon_loc">
				<span class="mobile-contacts__text">
					<?= \Yii::$app->controller->geo_city ?>
				</span>
			</div>
			<div class="mobile-contacts__contact mobile-contacts__contact_phone">
				<img src="<?= Url::to('@web/img/call-answer.svg') ?>" alt="" class="mobile-contacts__icon">
                <a href="<?=$right_tel?>" class="mobile-contacts__text mobile-contacts__text_phone">
                    <?= \Yii::$app->controller->contacts->phone ?>
                </a>
			</div>
			<div class="mobile-contacts__contact mobile-contacts__contact_phone">
				<img src="<?= Url::to('@web/img/close-envelope.svg') ?>" alt="" class="mobile-contacts__icon">
				<a href="mailto:<?= \Yii::$app->controller->contacts->email ?>" class="mobile-contacts__text mobile-contacts__text_mail">
					<?= \Yii::$app->controller->contacts->email ?>
				</a>
			</div>
		</div>
		<form class="mobile-search">
			<input class="mobile-search__input" type="text">
			<button type="button" class="mobile-search__btn">
				<img src="<?= Url::to('@web/img/search.png') ?>" alt="Поиск">
			</button>
		</form>
	</div>
	<header class="header">
		<div class="hdr-top">
			<div class="container">
				<div class="row">
					<div class="col d-flex align-items-center justify-content-between">
						<button class="bars">
							<img src="<?= Url::to('@web/img/menu.svg') ?>" alt="Меню">
						</button>
						<a class="logo" href="<?= \Yii::$app->urlManager->createAbsoluteUrl('site/index') ?>">
							<img src="<?= Url::to('@web/img/logo.png') ?>" alt="Грузовоз">
						</a>
                        <a href="tel:<?=$right_tel?>" class="phone">
                            <?= \Yii::$app->controller->contacts->phone ?>
                        </a>
						<div class="sub-wrapp">
							<div class="city">
								<img src="<?= Url::to('@web/img/location.png') ?>" alt="" class="city__icon">
								<p class="city__text">
                                    <?= \Yii::$app->controller->geo_city ?>
								</p>
                                <?php
                                    if (!isset($_COOKIE['geo_city_confirmed'])) {
                                ?>
                                    <div class="bubble bubble-top" style="top:20px;">
                                        <i class="arrow-before"></i>
                                        <i class="arrow-after"></i>
                                        <?php
                                            if (\Yii::$app->controller->geo_city == 'Неизвестно') {
                                        ?>
                                            <div class="bubble-main">
                                                <p>Мы не смогли угадать Ваш город</p>
                                                <?= Html::input('text', 'geo_city', '', ['id' => 'geo_city_input_new', 'placeholder' => 'Ваш город']) ?>
                                                <?= Html::button('Сохранить', ['id' => 'yes_save_button']) ?>
                                                <?= Html::button('Закрыть', ['id' => 'no_cancel_button']) ?>
                                            </div>
                                        <?php
                                            } else {
                                        ?>
                                            <div class="bubble-main">
                                                <p>Это ваш город?</p>
                                                <?= Html::button('Да', ['id' => 'yes_button']) ?>
                                                <?= Html::button('Нет', ['id' => 'no_button']) ?>
                                                <?= Html::input('text', 'geo_city', '', ['id' => 'geo_city_input', 'placeholder' => 'Ваш город']) ?>
                                                <?= Html::button('Подтвердить', ['id' => 'geo_city_button']) ?>
                                            </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                <?php
                                    }
                                ?>
							</div>
						
							<ul class="main-menu" style="width:100px">
								<li style="width:100%">
									<a class="main-menu__item main-menu__item_calc" href="<?= \Yii::$app->urlManager->createAbsoluteUrl('order/index') ?>"></a>
								</li>
							</ul>
						</div>
                        <?php
                            if (Yii::$app->user->isGuest) {
                                $cabinet_link = \Yii::$app->urlManager->createAbsoluteUrl('site/login');
                            } else {
                                $cabinet_link = \Yii::$app->urlManager->createAbsoluteUrl('client/index');
                            }
                        ?>
						<a href="<?= $cabinet_link ?>" class="cabinet">
                            <?= Html::img('@web/img/user.png', ['class' => 'cabinet__icon']) ?>
							<p class="cabinet__text">
								<?php
                                    if (Yii::$app->user->isGuest) {
                                        echo 'Вход / Регистрация';
                                    } else {
                                        echo 'Личный кабинет';
                                        echo Html::beginForm([Url::to('@web/site/logout')], 'post');
                                        echo Html::submitButton(
                                            '',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }
                                ?>
							</p>
						</a>

                        <button type="button" class="hdr-order">
                            <img src="<?= Url::to('@web/img/delivery.svg') ?>" alt="Оформить заказ">
                            <span>
                                <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('order/index') ?>">Оформить заказ</a>
                            </span>
                        </button>
					</div>
				</div>
			</div>
		</div>

        <?php if ($this->context->route == 'site/index') { ?>

            <!-- Блок на главной -->
            <?= $this->context->renderPartial('/modules/_index_block'); ?>

        <?php } ?>
	</header>

    <?php if ($this->context->route !== 'site/index') { ?>
        <section class="bc-section">
            <div class="container">
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => 'Главная',
                        'url' => ['/'],
                    ],
                    'links' => $this->params['breadcrumbs'],
                ]) ?>
            </div>
        </section>
<?php //  $this->params['breadcrumbs']?>
        <section class="alert-section">
            <div class="container">
                <?= Alert::widget() ?>
            </div>
        </section>
    <?php } ?>
<div class="wrap">
	  <?= $content ?>
</div>

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-xl-2">
					<a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('site/index') ?>" class="ftr-logo">
						<img src="<?= Url::to('@web/img/logo.png') ?>" alt="Грузовоз">
					</a>
				</div>
				<div class="col-lg-7 col-xl-8 d-sm-flex justify-content-around justify-content-lg-start">
					<div class="ftr-info">
						<h4 class="ftr-info__title title">
							О компании
						</h4>
						<ul class="ftr-info__list">
							<li>
								<a href="/site/about">
									О нас
								</a>
							</li>
							<li>
								<a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('site/news') ?>">
									Новости
								</a>
							</li>

							<li>
								<a href="/site/contact">
									Контакты
								</a>
							</li>
						</ul>
					</div>
					<div class="ftr-info">
						<h4 class="ftr-info__title title">
							Услуги
						</h4>
						<ul class="ftr-info__list">
							<?php foreach ($article_for_service as $item) { ?>
							<li>
								<a href="/site/articles/<?=$item->article_id?>">
								<?=$item->title?>
								</a>
							</li>
							<?  }  ?>
						</ul>
					</div>
					<div class="ftr-info">
						<h4 class="ftr-info__title title">
							Клиентам
						</h4>
						<ul class="ftr-info__list">
							<?php foreach ($article_for_customer as $item) { ?>
							<li>
								<a href="/site/articles/<?=$item->article_id?>">
								<?=$item->title?>
								</a>
							</li>
							<?  }  ?>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-xl-2">
					<div class="contacts">
						<div class="contacts__contact">
							<img src="<?= Url::to('@web/img/envelope.png') ?>" alt="">
                            <?= Html::mailto(\Yii::$app->controller->contacts->email, \Yii::$app->controller->contacts->email) ?>
						</div>
						<div class="contacts__contact">
							<img src="<?= Url::to('@web/img/call-answer.png') ?>" alt="">
							<a href="tel:<?=$right_tel?>">
                                <?= \Yii::$app->controller->contacts->phone ?>
							</a>
						</div>
						<ul class="social">
							<li>
								<a class="social__link_fb" target="_blank" href="#">
								</a>
							</li>
							<li>
								<a class="social__link_in" target="_blank" href="#">
								</a>
							</li>
							<li>
								<a class="social__link_vk" target="_blank" href="#">
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
