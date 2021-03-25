<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\LegalForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EntityAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Юридические лица';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?= Html::a('Создать юридическое лицо', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'entity_address_id',
            [
                'attribute'=>'legal_form_id',
                'format' => 'raw',
                'filter' => ArrayHelper::map(LegalForm::find()->all(), 'legal_form_id', 'name'),
                'value' => function($data) {
                    return $data->legalForm->name;
                },
            ],
            'name',
            'inn',
            'kpp',
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
