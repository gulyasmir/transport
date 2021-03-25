<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DedicatedTransportTruckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выделенный транспорт фура';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dedicated-transport-truck-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?= Html::a('Создать заказ (Выделенный транспорт фура)', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'dt_truck_id',
                'filter' => true,
                'options' => ['style' => 'width: 35px; max-width: 35px;'],
                'contentOptions' => ['style' => 'width: 35px; max-width: 35px;'], 
            ],
            [
                'attribute'=>'orderNumber',
                'filter' => true,
                'value'=>function ($data) {
                   return Html::encode($data->order->order_number);
                },
            ],
            [
                'attribute'=>'status',
                'filter' => \Yii::$app->params['status'],
                'value'=>function ($data) {
                    if ($data->order->status > 0) {
                        return Html::encode(\Yii::$app->params['status'][$data->order->status]);
                    } else {
                        return '-';
                    }
                },
            ],
            //[
            //    'attribute'=>'userName',
            //    'filter' => true,
            //    'value'=>function ($data) {
            //       return Html::encode($data->user->name);
            //    },
            //],
            //[
            //    'attribute'=>'userSurname',
            //    'filter' => true,
            //    'format' => 'raw',
            //    'value'=>function ($data) {
            //       return Html::encode($data->user->surname);
            //    },
            //],
            //[
            //    'attribute'=>'userPhone',
            //    'filter' => true,
            //    'format' => 'raw',
            //    'value'=>function ($data) {
            //       return Html::encode($data->user->phone);
            //    },
            //],
            [
                'attribute'=>'from',
                'filter' => true,
                'value'=>function ($data) {
                   return Html::encode($data->order->from);
                },
            ],
            [
                'attribute'=>'to',
                'filter' => true,
                'value'=>function ($data) {
                   return Html::encode($data->order->to);
                },
            ],
            [
                'attribute'=>'pick_up_date',
                'value' => 'formattedDate',
                'filter' => false,
                'options' => ['style' => 'width: 85px; max-width: 85px;'],
                'contentOptions' => ['style' => 'width: 85px; max-width: 85px;'], 
            ],
            [
                'attribute'=>'order.sender',
                'header' => ' Плательщик',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    
                    if ($data->order->payer_id == $data->order->sender_id) {
                        
                        return 'Отправитель';
                        
                    } elseif ($data->order->payer_id == $data->order->recipient_id) {
                        
                        return 'Получатель';
                    }
                },
            ],
            [
                'attribute'=>'order.sender',
                'header' => ' Отправитель',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    
                    if (isset($data->order->sender->individualAddress->address_id)) {
                        
                        return Html::a('Физ. адрес', ["/individual-address/index?IndividualAddressSearch[individual_address_id]={$data->order->sender->individualAddress->individual_address_id}"], ['data-pjax' => 0]);
                        
                    } elseif (isset($data->order->sender->entityAddress->address_id)) {
                        
                        return Html::a('Юр. адрес', ["/entity-address/index?EntityAddressSearch[entity_address_id]={$data->order->sender->entityAddress->entity_address_id}"], ['data-pjax' => 0]);
                    }  
                },
            ],
            [
                'attribute'=>'order.recipient',
                'header' => ' Получатель',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    
                    if (isset($data->order->recipient->individualAddress->address_id)) {
                        
                        return Html::a('Физ. адрес', ["/individual-address/index?IndividualAddressSearch[individual_address_id]={$data->order->recipient->individualAddress->individual_address_id}"], ['data-pjax' => 0]);
                        
                    } elseif (isset($data->order->recipient->entityAddress->address_id)) {
                        
                        return Html::a('Юр. адрес', ["/entity-address/index?EntityAddressSearch[entity_address_id]={$data->order->recipient->entityAddress->entity_address_id}"], ['data-pjax' => 0]);
                    }  
                },
            ],
            [
                'attribute'=>'order.user_id',
                'header' => ' Пользователь',
                'format' => 'raw',
                'filter' => ArrayHelper::map(User::find()->where(['role' => 1])->all(), 'id', 'username'),
                'value' => function($data) {
                    return Html::a($data->order->user->username, ["/user/index?UserSearch[id]={$data->order->user_id}"], ['data-pjax' => 0]);
                }, 
            ],
            [
                'attribute'=>'documents',
                'header' => ' Докумнеты',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    if (count($data->order->documents)) {
                        return Html::a('Документы', ["/documents/index?DocumentsSearch[order_id]={$data->order->order_id}"], ['data-pjax' => 0]);
                    } else {
                        return 'Нет документов';
                    }
                    
                }, 
            ],
            [
                'attribute'=>'upload_document',
                'header' => ' Загрузить документ',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    return Html::a('Загрузить', ["/documents/create?order_id={$data->order->order_id}"], ['data-pjax' => 0]);
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
