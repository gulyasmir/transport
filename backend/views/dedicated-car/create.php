<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DedicatedTransportCar */

$this->title = 'Создание заказа (Выделенный транспорт машина)';
$this->params['breadcrumbs'][] = ['label' => 'Выделенный транспорт машина', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dedicated-transport-car-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
