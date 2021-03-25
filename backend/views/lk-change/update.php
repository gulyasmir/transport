<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LkChange */

$this->title = 'Изменить: ' . $model->name_page;
$this->params['breadcrumbs'][] = ['label' => 'Текст и образец заявления для страниц Изменить данные заказа', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_page, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="lk-change-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
