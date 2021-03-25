<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LkPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Главная в Личном кабинете (вкладки)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lk-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lk Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text_info:ntext',
            'text_cooperation:ntext',
            'text_help:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '&nbsp;{update}',
            ],
        ],
    ]); ?>
</div>
