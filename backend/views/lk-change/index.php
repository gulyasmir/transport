<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LkChangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Текст и образец заявления для страниц Изменить данные заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lk-change-index">

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
            'text:ntext',
            'pdf',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '&nbsp;{update}',
            ],
        ],
    ]); ?>
</div>
