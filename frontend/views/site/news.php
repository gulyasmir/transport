<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

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

<section class="news-section list-news-section">
    <div class="container">

        <h1 class="section-title"><?=$text_for_page->title_seo ?></h1>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '/modules/_news_list',
                'options' => [
                    'tag' => 'div',
                    'class' => 'row',
                ],
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-lg-6',
                ],
                'emptyText' => 'Новостей нет.',
                'pager' => [
                    'firstPageLabel' => 'Первая',
                    'lastPageLabel' => 'Последняя',
                    'nextPageLabel' => '>',
                    'prevPageLabel' => '<',
                    'maxButtonCount' => 5,
                ],
                'layout' => "{items}\n<div class='pager'>{pager}</div>",
            ]);
        ?>

        <div class="text_for_page">
          <h2><?=$text_for_page->title_text ?></h2>
          <div class="text_for_page"><?=$text_for_page->text ?></div>
        </div>
    </div>
</section>
