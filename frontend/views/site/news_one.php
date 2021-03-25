<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $new->title;
$this->registerMetaTag(['name' => 'description', 'content' => $new->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $new->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['news']];
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
                    if ($new->image) {
                        echo Html::img(\Yii::$app->params['news_web_path'].'/'.$new->image);
                    }
                ?>
            </div>
            <div class="col-sm-5 col-lg-7">
                <?= $new->text ?>
            </div>
        </div>
        
    </div>
</section>
