<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

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
<div class="site-contact container">
    <h1><?= Html::encode($this->title) ?></h1>
      <hr>

<div id="map"></div>
<div id="map-menu"></div>



<div class="text_for_page">
  <h2><?=$text_for_page->title_text ?></h2>
  <div class="text_for_page"><?=$text_for_page->text ?></div>
</div>


<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=611985b3-6f3d-41e9-b912-0cd440f00146" type="text/javascript"></script>
 <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>




 <script>
 var groups = [
        {
            name: " ",
            style: "islands#redIcon",
            items: [
<?php foreach ($shops as $shop) { ?>
  {
      center: [<?=$shop->location?>],
      name: "<?=$shop->name?>",
      adress:"<?=$shop->adress?>",
      tel1:"<?=$shop->tel1?>",
      tel2:"<?=$shop->tel2?>",
      mail:"<?=$shop->mail?>",
      workingdays:"<?=$shop->workingdays?>",
      weekend:"<?=$shop->weekend?>"
  },
  <?php } ?>
        ]},

    ];
 </script>

 <script>
 ymaps.ready(init);

 function init() {

     // Создание экземпляра карты.
     var myMap = new ymaps.Map('map', {
             center: [50.443705, 30.530946],
             zoom: 8
         }, {
             searchControlProvider: 'yandex#search'
         }),
         // Контейнер для меню.
         menu = $('<ul class="menu"></ul>');

     for (var i = 0, l = groups.length; i < l; i++) {
         createMenuGroup(groups[i]);
     }

     function createMenuGroup (group) {
         // Пункт меню.
         var menuItem = $('<li><a href="#">' + group.name + '</a></li>'),
         // Коллекция для геообъектов группы.
             collection = new ymaps.GeoObjectCollection(null, { preset: group.style }),
         // Контейнер для подменю.
             submenu = $('<ul class="submenu"></ul>');

         // Добавляем коллекцию на карту.
         myMap.geoObjects.add(collection);
         // Добавляем подменю.
         menuItem
             .append(submenu)
             // Добавляем пункт в меню.
             .appendTo(menu)
             // По клику удаляем/добавляем коллекцию на карту и скрываем/отображаем подменю.
             .find('a')
             .bind('click', function () {
                 if (collection.getParent()) {
                     myMap.geoObjects.remove(collection);
                     submenu.hide();
                 } else {
                     myMap.geoObjects.add(collection);
                     submenu.show();
                 }
             });
         for (var j = 0, m = group.items.length; j < m; j++) {
             createSubMenu(group.items[j], collection, submenu);
         }
     }

     function createSubMenu (item, collection, submenu) {
         // Пункт подменю.
         var submenuItem = $('<li><table class="map-item-table"><tr><td><a href="#">' + item.name + '</a><p>' + item.adress + '</p></td><td><p>' + item.tel1 + '</p><p>' + item.tel2 + '</p><p>' + item.mail + '</p></td><td><p>Часы работы:</p><p>' + item.workingdays + '</p><p>Выходный дни:</p><p>' + item.weekend + '</p></td></tr> </table></li>'),
         // Создаем метку.
             placemark = new ymaps.Placemark(item.center, { balloonContent: item.name });

         // Добавляем метку в коллекцию.
         collection.add(placemark);
         // Добавляем пункт в подменю.
         submenuItem
             .appendTo(submenu)
             // При клике по пункту подменю открываем/закрываем баллун у метки.
             .find('a')
             .bind('click', function () {
                 if (!placemark.balloon.isOpen()) {
                     placemark.balloon.open();
                 } else {
                     placemark.balloon.close();
                 }
                 return false;
             });
     }

     // Добавляем меню в тэг BODY.
     menu.appendTo($('#map-menu'));
     // Выставляем масштаб карты чтобы были видны все группы.
     myMap.setBounds(myMap.geoObjects.getBounds());
 }
</script>



  </div>
