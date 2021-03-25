<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LkChange */

$this->title = 'Create Lk Change';
$this->params['breadcrumbs'][] = ['label' => 'Lk Changes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lk-change-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
