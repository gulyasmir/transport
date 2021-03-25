<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DedicatedTransportTruck */

$this->title = 'Создание заказа (Выделенный транспорт фура)';
$this->params['breadcrumbs'][] = ['label' => 'Выделенный транспорт фура', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dedicated-transport-truck-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
