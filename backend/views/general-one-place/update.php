<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralCargoOnePlace */

$this->title = 'Изменение заказа (Сборный груз 1 место) ' . $model->order->order_number;
$this->params['breadcrumbs'][] = ['label' => 'Сборный груз 1 место', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-cargo-one-place-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
