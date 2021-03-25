<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'news_id',
                'filter' => true,
                'options' => ['style' => 'width: 35px; max-width: 35px;'],
                'contentOptions' => ['style' => 'width: 35px; max-width: 35px;'], 
            ],
            [
                'attribute'=>'date',
                'value' => 'formattedDate',
                'filter' => false,
                'options' => ['style' => 'width: 65px; max-width: 65px;'],
                'contentOptions' => ['style' => 'width: 65px; max-width: 65px;'], 
            ],
            [
                'attribute'=>'title',
                'filter' => true,
                'options' => ['style' => 'width: 180px; max-width: 180px;'],
                'contentOptions' => ['style' => 'word-wrap: break-word;white-space: normal;width: 180px; max-width: 180px;'], 
            ],
            [
                'attribute'=>'text',
                'filter' => true,
                'format' => 'raw',
                'value' => function($data) {
                    return StringHelper::truncate($data->text, 100, '...');
                },
                'options' => ['style' => 'width: 350px; max-width: 350px;'],
                'contentOptions' => ['style' => 'word-wrap: break-word;white-space: normal;width: 350px; max-width: 350px;'], 
            ],
            [
                'attribute'=>'keywords',
                'filter' => true,
                'options' => ['style' => 'width: 150px; max-width: 150px;'],
                'contentOptions' => ['style' => 'word-wrap: break-word;white-space: normal;width: 150px; max-width: 150px;'], 
            ],
            [            
                'attribute'=>'image',
                'format' => 'html',
                'filter' => false,
                'value' => function($data) {
                    return Html::img(\Yii::$app->params['news_http_path'].'/'.$data->image, ['style' => 'width: 100px;']);
                },    
            ], 

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
