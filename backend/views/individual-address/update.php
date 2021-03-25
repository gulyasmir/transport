<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualAddress */

$this->title = 'Редактирование физического лица #' . $model->individual_address_id;
$this->params['breadcrumbs'][] = ['label' => 'Физические лица', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individual-address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
