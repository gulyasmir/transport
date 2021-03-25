<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TextForPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тексты для страниц сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-for-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'page',
            'name_page',
            'title_text:ntext',
          //  'text:ntext',
          'title_seo',
            'description',
          'keywords',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;&nbsp;{update}',
            ],
        ],
    ]); ?>
</div>
