<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Мои заказы';
?>

<section class="client-section">
    <div class="container">
       

        <div class="row">
            <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>

            <div class="col-md-9 client-info">
            	
 <div class="block-with-frame"> 
  <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
                <div id="create-client-order">
                    <a href="/order">Создать заказ</a>
                </div>

                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                 //   'filterModel' => $searchModel,
                    'columns' => [
                    //  ['class' => 'yii\grid\SerialColumn'],
 
                        //[
                        //    'attribute'=>'create_date',
                        //    'format' => ['date', 'dd.MM.yyyy'],
                        //],

                        [
                            'attribute'=>'order_number',
                            'format' => 'raw',
                           'value' => function($data) {
                               return $data->order_number ? "<a href='/client/order?order_id={$data->order_id}'>{$data->order_number}</a>" : '-';
                           },
                      //  'value' => function($data) {
                          //   return $data->order_number ? "{$data->order_number}" : '-';
                         //  },
                            'options' => ['style' => 'width: 20%; '],
                            'contentOptions' => ['style' => 'text-align:center;width: 20%;'],
                        ],
                    /*    [
                            'attribute'=>'invoice',
                            'format' => 'raw',
                            'value' => function($data) {
                                return $data->invoice ? $data->invoice : '-';
                            },
                            'options' => ['style' => 'width: 95px; max-width: 95px;'],
                            'contentOptions' => ['style' => 'text-align:center;width: 95px; max-width: 95px;'],
                        ],
                        [
                            'attribute'=>'number_of_departure',
                            'format' => 'raw',
                            'value' => function($data) {
                                return $data->number_of_departure ? $data->number_of_departure : '-';
                            },
                            'options' => ['style' => 'width: 95px; max-width: 95px;'],
                            'contentOptions' => ['style' => 'text-align:center;width: 95px; max-width: 95px;'],
                        ],
*/
                        [
                            'attribute'=>'from',
                            'format' => 'raw',
                          'options' => ['style' => 'width: 25%; '],
                            'contentOptions' => ['style' => 'text-align:center;width: 20%; '],
                        ],

                        [
                            'attribute'=>'to',
                            'format' => 'raw',
                           'options' => ['style' => 'width: 25%; '],
                            'contentOptions' => ['style' => 'text-align:center;width: 20%; '],
                        ],

                        [
                            'attribute'=>'status',
                            'format' => 'raw',
                            'filter' => \Yii::$app->params['status'],
                            'value' => function($data) {
                                return \Yii::$app->params['status'][$data->status];
                            },
                           'options' => ['style' => 'width: 20%; '],
                            'contentOptions' => ['style' => 'text-align:center;width:20%; '],
                        ],

                       
                     //    [
		            //    'class' => 'yii\grid\ActionColumn'
		             
		        //	   ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </p>
        </div>
        </div>
    </div>
</section>
