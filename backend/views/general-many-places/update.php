<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralCargoManyPlaces */

$this->title = 'Изменение заказа (Сборный груз несколько мест) ' . $model->order->order_number;
$this->params['breadcrumbs'][] = ['label' => 'Сборный груз несколько мест', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-cargo-many-places-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
