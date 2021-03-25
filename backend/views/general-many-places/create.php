<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralCargoManyPlaces */

$this->title = 'Создание заказа (Сборный груз несколько мест)';
$this->params['breadcrumbs'][] = ['label' => 'Сборный груз несколько мест', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-cargo-many-places-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
