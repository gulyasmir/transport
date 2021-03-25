<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Адресная книга';
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
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                 //   'filterModel' => $searchModel,
                    'columns' => [
                    //    ['class' => 'yii\grid\SerialColumn'],

                        //[
                        //    'attribute'=>'create_date',
                        //    'format' => ['date', 'dd.MM.yyyy'],
                        //],

                        [
                            'attribute'=>'type',
                            'format' => 'raw',
                            'filter' => \Yii::$app->params['payers'],
                            'value' => function($data) {
                                return \Yii::$app->params['payers'][$data->type];
                            },
                            'options' => ['style' => 'width:20%; '],
                            'contentOptions' => ['style' => 'text-align:center;width:20%;'],
                        ],

                        [
                            'attribute'=>'address',
                            'format' => 'raw',
                              'options' => ['style' => 'width:20%; '],
                            'contentOptions' => ['style' => 'text-align:center;width:20%;'],
                        ],
                        [
                            'attribute'=>'contact_person',
                            'format' => 'raw',
                               'options' => ['style' => 'width:20%; '],
                            'contentOptions' => ['style' => 'text-align:center;width:20%;'],
                        ],
                        [
                            'attribute'=>'phone',
                            'format' => 'raw',
                              'options' => ['style' => 'width:20%; '],
                            'contentOptions' => ['style' => 'text-align:center;width:20%;'],
                        ],

                    //   [ 'class' => 'yii\grid\ActionColumn' ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </p>
        </div>
    </div></div>
</section>
