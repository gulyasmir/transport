<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactShops */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Адреса  на карте', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-shops-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'location',
            'workingdays',
            'weekend',
            'adress:ntext',
            'tel1',
            'tel2',
            'mail',
        ],
    ]) ?>

</div>
