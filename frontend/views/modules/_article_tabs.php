
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>

<?php if (isset($articles) && count($articles)) { ?>
    <div class="row no-gutters">
        <div class="col-md-4 z-in">
            <ul class="serv-list">
                <?php foreach($articles as $k => $article) { ?>
                    <li class="<?php if (!$k) echo 'el-active'; ?>">
                        <?= $article->title; ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-8">
            <?php foreach($articles as $k => $article) { ?>
                <div class="serv-descr <?php if (!$k) echo 'el-active'; ?>">
                    <div class="serv-descr__img-wrap">
                        <?php
                            if ($article->image) {
                                echo Html::img(\Yii::$app->params['articles_web_path'].'/'.$article->image, ['class' => 'fit-cover serv-descr__img']);
                            }
                        ?>
                    </div>
                    <div class="serv-descr__text-wrap">
                        <h2 class="serv-descr__title title">
                            <?= $article->title; ?>
                        </h2>
                        <p class="serv-descr__text">
                            <?php
                                $text = StringHelper::truncate($article->text, 1000, '...');
                                echo $text;
                            ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
            <div class="link-wrap">
                <div class="link">
                    <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('site/articles')?>">
                      Все статьи
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
