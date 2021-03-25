<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IndividualAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Физические лица';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individual-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?= Html::a('Создать физическое лицо', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            //'identification_series',
            //'identification_number',

            'individual_address_id',
            'full_name',
            [
                'attribute'=>'identification',
                'format' => 'raw',
                'filter' => \Yii::$app->params['identification'],
                'value' => function($data) {
                    return \Yii::$app->params['identification'][$data->identification].' '.$data->identification_series.' '.$data->identification_number.', выдан '.$data->identification_uvd.' '.$data->identification_date;
                },
            ],
            [
                'attribute'=>'address.address',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->address->address;
                },
            ],
            [
                'attribute'=>'address.phone',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->address->phone;
                },
            ],
            [
                'attribute'=>'address.contact_person',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->address->contact_person;
                },
            ],
            [
                'attribute'=>'address.user_id',
                'header' => ' Пользователь',
                'format' => 'raw',
                'filter' => ArrayHelper::map(User::find()->where(['role' => 1])->all(), 'id', 'username'),
                'value' => function($data) {
                    return Html::a($data->address->user->username, ["/user/index?UserSearch[id]={$data->address->user_id}"], ['data-pjax' => 0]);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;',// {delete}
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
