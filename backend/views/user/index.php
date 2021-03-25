<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!-- <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'filter' => true,
                'options' => ['style' => 'width: 35px; max-width: 35px;'],
                'contentOptions' => ['style' => 'width: 35px; max-width: 35px;'], 
            ],
            [
                'attribute'=>'created_at',
                'value' => 'formattedDate',
                'filter' => false,
                'options' => ['style' => 'width: 65px; max-width: 65px;'],
                'contentOptions' => ['style' => 'width: 65px; max-width: 65px;'], 
            ],
            [
                'attribute'=>'username',
                'filter' => true,
            ],
            [
                'attribute'=>'email',
                'filter' => true,
                'format' => 'email',
            ],
            [
                'attribute'=>'name',
                'filter' => true,
            ],
            [
                'attribute'=>'surname',
                'filter' => true,
            ],
            [
                'attribute'=>'phone',
                'filter' => true,
            ],
            [
                'attribute'=>'role',
                'format' => 'raw',
                'filter' => \Yii::$app->params['role'],
                'value' => function($data) {
                    $style = '';
                    if ($data->role == 10) {
                        $style = 'style="color:red;"';
                    }
                    return '<span '.$style.'>'.\Yii::$app->params['role'][$data->role].'</span>';
                }, 
            ],

          //  [
              //  'class' => 'yii\grid\ActionColumn',
               // 'template' => '{update}&nbsp;',
           // ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
