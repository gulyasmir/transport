<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LegalFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Правовые формы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать правовую форму', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'legal_form_id',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;',// {delete}
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
