
<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
?>

<a href="<?= \Yii::$app->urlManager->createAbsoluteUrl("site/news/{$model->news_id}") ?>" class="news">
    <div class="news__img-wrap">
        <?php
            if ($model->image) {
                echo Html::img(\Yii::$app->params['news_web_path'].'/'.$model->image, ['class' => 'fit-cover news__img']);
            }
        ?>
    </div>
    <div class="news__content">
        <p class="news__date">
            <time datetime="<?= date('Y-m-d', $model->date) ?>">
                <?= date('d.m.Y', $model->date) ?>
            </time>
        </p>
        <h3 class="news__title title">
            <?= $model->title; ?>
        </h3>
        <div class="news__text">
            <?php
                $text = StringHelper::truncate($model->text, 100, '...');
                echo $text;
            ?>
        </div>
    </div>
</a>
