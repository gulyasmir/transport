<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'contact_id',
                'filter' => false,
                'options' => ['style' => 'width: 35px; max-width: 35px;'],
                'contentOptions' => ['style' => 'width: 35px; max-width: 35px;'], 
            ],
            [
                'attribute'=>'phone',
                'filter' => false,
            ],
            [
                'attribute'=>'email',
                'filter' => false,
                'format' => 'email',
            ],
            [
                'attribute'=>'address',
                'filter' => false,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
