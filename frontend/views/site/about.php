<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

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
<div class="site-about">
  <section class="news-section list-news-section">
      <div class="container">

          <h1 class="section-title"><?=$text_for_page->title_text ?></h1>
  <div class="text_for_page"><?=$text_for_page->text ?></div>


  </div>
</section>

</div>
