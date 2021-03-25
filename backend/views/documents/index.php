<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?= Html::a('Загрузить документ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'document_id',
                'filter' => true,
                'options' => ['style' => 'width: 35px; max-width: 35px;'],
                'contentOptions' => ['style' => 'width: 35px; max-width: 35px;'], 
            ],
            [
                'attribute'=>'create_date',
                'format' => ['date', 'dd.MM.yyyy'],
                'options' => ['style' => 'width: 125px; max-width: 125px;'],
                'contentOptions' => ['style' => 'width: 125px; max-width: 125px;'], 
            ],
            [
                'attribute'=>'title',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->title, \Yii::$app->request->hostInfo.\Yii::$app->params['documents_http_path'].'/'.$data->name, ['target' => '_blank', 'data-pjax' => 0]);
                },
            ],
            
            //'name',
            //'uploader',
            
            [
                'attribute'=>'uploader',
                'format' => 'raw',
                'filter' => \Yii::$app->params['uploader'],
                'value' => function($data) {
                    return \Yii::$app->params['uploader'][$data->uploader];
                },
                'options' => ['style' => 'width: 125px; max-width: 125px;'],
                'contentOptions' => ['style' => 'width: 125px; max-width: 125px;'], 
            ],
            
            [
                'attribute'=>'order.order_id',
                'header' => ' Заказ',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    
                    $order_data = [];
                    $get_param = 0;
                    $view = '';
                    
                    // Сборный груз одно место
                    if (mb_stripos($data->order->order_number, 'СО-') !== false) {
                        
                        if (isset($data->order->generalCargoOnePlace['order_id'])) {
                            $order_data = $data->order->generalCargoOnePlace;
                            $get_param = 'GeneralCargoOnePlace[gc_one_place_id]='.$data->order->generalCargoOnePlace->gc_one_place_id;
                            $view = 'general-one-place';
                        }
                        
                    // Сборный груз несколько мест
                    } elseif (mb_stripos($data->order->order_number, 'СМ-') !== false) {
                        
                        if (isset($data->order->generalCargoManyPlace['order_id'])) {
                            $order_data = $data->order->generalCargoManyPlace;
                            $get_param = 'GeneralCargoManyPlace[gc_many_places_id]='.$data->order->generalCargoManyPlace->gc_many_places_id;
                            $view = 'general-many-places';
                        }
                        
                    // Сборный груз письмо
                    } elseif (mb_stripos($data->order->order_number, 'СП-') !== false) {
                        
                        if (isset($data->order->generalCargoLetter['order_id'])) {
                            $order_data = $data->order->generalCargoLetter;
                            $get_param = 'GeneralCargoLetter[gc_letter_id]='.$data->order->generalCargoLetter->gc_letter_id;
                            $view = 'general-letter';
                        }
                        
                    // Выделенный транспорт фура
                    } elseif (mb_stripos($data->order->order_number, 'ВФ-') !== false) {
                        
                        if (isset($data->order->dedicatedTransportTruck['order_id'])) {
                            $order_data = $data->order->dedicatedTransportTruck;
                            $get_param = 'DedicatedTransportTruck[dt_truck_id]='.$data->order->dedicatedTransportTruck->dt_truck_id;
                            $view = 'dedicated-truck';
                        }
                        
                    // Выделенный транспорт машина
                    } elseif (mb_stripos($data->order->order_number, 'ВМ-') !== false) {
                        
                        if (isset($data->order->dedicatedTransportCar['order_id'])) {
                            $order_data = $data->order->dedicatedTransportCar;
                            $get_param = 'DedicatedTransportCar[dt_car_id]='.$data->order->dedicatedTransportCar->dt_car_id;
                            $view = 'dedicated-car';
                        }
                    }
                    
                    if ($get_param && $view) {
                        return Html::a($data->order->order_number, ["/{$view}/index?{$get_param}"], ['data-pjax' => 0]);
                    } else {
                        return '-';
                    }
                },
                'options' => ['style' => 'width: 125px; max-width: 125px;'],
                'contentOptions' => ['style' => 'width: 125px; max-width: 125px;'], 
            ],
            [
                'attribute'=>'user.user_id',
                'header' => ' Пользователь',
                'format' => 'raw',
                'filter' => ArrayHelper::map(User::find()->where(['role' => 1])->all(), 'id', 'username'),
                'value' => function($data) {
                    return Html::a($data->order->user->username, ["/user/index?UserSearch[id]={$data->order->user_id}"], ['data-pjax' => 0]);
                },
                'options' => ['style' => 'width: 145px; max-width: 145px;'],
                'contentOptions' => ['style' => 'width: 145px; max-width: 145px;'], 
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}', // {update}&nbsp;&nbsp;
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
