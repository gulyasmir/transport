<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DedicatedTransportCar */

$this->title = 'Изменение заказа (Выделенный транспорт машина) ' . $model->order->order_number;
$this->params['breadcrumbs'][] = ['label' => 'Выделенный транспорт фура', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dedicated-transport-car-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
