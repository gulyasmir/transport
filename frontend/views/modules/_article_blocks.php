
<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if (isset($articles) && count($articles)) { ?>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="margin"></div>
        </div>
        <?php foreach($articles as $article) { ?>
            <div class="col-sm-6 col-lg-4">
                <div class="service-sub-wrap service-sub-wrap_first">
                    <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl("site/articles/{$article->article_id}") ?>" class="service-item">
                        <?php
                            if ($article->image) {
                                echo Html::img(\Yii::$app->params['articles_web_path'].'/'.$article->image, ['class' => 'fit-cover service-item__img']);
                            }
                        ?>
                        <div class="service-item__more">
                            <div class="service-item__sub-wrapp">
                                <p class="service-item__title title">
                                    <?= $article->title; ?>
                                </p>
                                <img src="<?= Url::to('@web/img/right-arrow.png') ?>" alt="Узнать больше" class="">
                            </div>
                        </div>
                    </a>						
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

