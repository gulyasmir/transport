<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LkChange */

$this->title = $model->name_page;
$this->params['breadcrumbs'][] = ['label' => 'Текст и образец заявления для страниц Изменить данные заказа', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lk-change-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'page',
            'name_page',
            'text:ntext',
            'pdf',
        ],
    ]) ?>

</div>
