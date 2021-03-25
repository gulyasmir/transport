<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EntityAddress */

$this->title = 'Создание юридического адреса';
$this->params['breadcrumbs'][] = ['label' => 'Юридические адреса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
