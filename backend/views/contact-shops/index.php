<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactShopsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Адреса  на карте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-shops-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
          //  'location',
          //  'workingdays',
          //  'weekend',
            // 'adress:ntext',
           'tel1',
           'tel2',
           'mail',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
