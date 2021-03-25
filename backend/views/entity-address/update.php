<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EntityAddress */

$this->title = 'Редактирование юридического лица #' . $model->entity_address_id;
$this->params['breadcrumbs'][] = ['label' => 'Юридические лица', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
