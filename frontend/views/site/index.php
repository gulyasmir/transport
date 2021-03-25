<?php
$this->title = $text_for_page->title_seo ;
$this->registerMetaTag([
  'name' => 'description',
  'content' => $text_for_page->description,
]);
$this->registerMetaTag([
'name' => 'keywords',
   'content' =>$text_for_page->keywords,
]);

?>

<section class="services-section">
    <div class="container">

        <!-- Cтатьи вкладками -->
        <?= $this->context->renderPartial('/modules/_article_tabs', ['articles' => $articles_tab]); ?>

        <!-- Cтатьи блоками -->
        <?= $this->context->renderPartial('/modules/_article_blocks', ['articles' => $articles_block]); ?>
</section>
<section class="news-section">
    <div class="container">

        <!-- Новости блоками -->
        <?php if (isset($news_block) && count($news_block)) { ?>
            <div class="row">
                <div class="col">
                    <h2 class="news-title title">
                        Новости компании
                    </h2>
                </div>
            </div>
        <?php } ?>
        <?= $this->context->renderPartial('/modules/_news_blocks', ['news' => $news_block]); ?>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="about">
                  <h2 class="about__title title"><?=$text_for_page->title_text ?></h2>
                  <div class="about__text"><?=$text_for_page->text ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
