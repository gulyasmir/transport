<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $article->title;
$this->registerMetaTag(['name' => 'description', 'content' => $article->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $article->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['articles']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="one-news-section">
    <div class="container">
        
        <h1 class="section-title"><?= $this->title ?></h1>
        
        <div class="row no-gutters">
            <div class="col-12">
                <div class="margin"></div>
            </div>
            <div class="col-sm-5 col-lg-4 image">
                <?php
                    if ($article->image) {
                        echo Html::img(\Yii::$app->params['articles_web_path'].'/'.$article->image);
                    }
                ?>
            </div>
            <div class="col-sm-5 col-lg-7">
                <?= $article->text ?>
            </div>
        </div>
        
    </div>
</section>