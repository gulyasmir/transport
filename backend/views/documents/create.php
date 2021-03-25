<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Documents */

$this->title = 'Загрузить документ к заказу #'. \Yii::$app->request->get('order_id');
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
