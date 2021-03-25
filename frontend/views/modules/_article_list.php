
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>

<div class="service-sub-wrap service-sub-wrap_first">
    <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl("site/articles/{$model->article_id}") ?>" class="service-item">
        <?php
            if ($model->image) {
                echo Html::img(\Yii::$app->params['articles_web_path'].'/'.$model->image, ['class' => 'fit-cover service-item__img']);
            }
        ?>
        <div class="service-item__more">
            <div class="service-item__sub-wrapp">
                <p class="service-item__title title">
                    <?= $model->title; ?>
                </p>
                <img src="<?= Url::to('@web/img/right-arrow.png') ?>" alt="Узнать больше" class="">
            </div>
        </div>
    </a>						
</div>