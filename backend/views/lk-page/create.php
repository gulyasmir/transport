<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LkPage */

$this->title = 'Create Lk Page';
$this->params['breadcrumbs'][] = ['label' => 'Lk Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lk-page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
