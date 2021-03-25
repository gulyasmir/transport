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

<section class="services-section list-articles-section">
    <div class="container">

        <h1 class="section-title"><?=$text_for_page->title_seo ?></h1>

        <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '/modules/_article_list',
                'options' => [
                    'tag' => 'div',
                    'class' => 'row no-gutters',
                ],
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-sm-6 col-lg-4',
                ],
                'emptyText' => 'Статей нет.',
                'pager' => [
                    'firstPageLabel' => 'Первая',
                    'lastPageLabel' => 'Последняя',
                    'nextPageLabel' => '>',
                    'prevPageLabel' => '<',
                    'maxButtonCount' => 5,
                ],
                'layout' => "<div class='col-12'><div class='margin'></div></div>{items}\n<div class='pager'>{pager}</div>",
            ]);
        ?>



        <div class="text_for_page">
          <h2><?=$text_for_page->title_text ?></h2>
          <div class="text_for_page"><?=$text_for_page->text ?></div>
        </div>

    </div>
</section>
