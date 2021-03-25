<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralCargoLetter */

$this->title = 'Изменение заказа (Сборный груз письмо) ' . $model->order->order_number;
$this->params['breadcrumbs'][] = ['label' => 'Сборный груз письмо', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-cargo-letter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
