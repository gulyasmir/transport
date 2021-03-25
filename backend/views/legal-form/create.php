<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LegalForm */

$this->title = 'Создание правовой формы';
$this->params['breadcrumbs'][] = ['label' => 'Правовые формы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
