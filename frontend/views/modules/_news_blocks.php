
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>

<?php if (isset($news) && count($news)) { ?>
    <div class="row">
        <?php foreach($news as $new) { ?>
            <div class="col-lg-6">
                <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl("site/news/{$new->news_id}") ?>" class="news">
                    <div class="news__img-wrap">
                        <?php
                            if ($new->image) {
                                echo Html::img(\Yii::$app->params['news_web_path'].'/'.$new->image, ['class' => 'fit-cover news__img']);
                            }
                        ?>
                    </div>
                    <div class="news__content">
                        <p class="news__date">
                            <time datetime="<?= date('Y-m-d', $new->date) ?>">
                                <?= date('d.m.Y', $new->date) ?>
                            </time>
                        </p>
                        <h3 class="news__title title">
                            <?= $new->title; ?>
                        </h3>
                        <div class="news__text">
                            <?php
                                $text = StringHelper::truncate($new->text, 100, '...');
                                echo $text;
                            ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
<?php } ?>