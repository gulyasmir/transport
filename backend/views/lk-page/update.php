<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LkPage */

$this->title = 'Изменить' ;
$this->params['breadcrumbs'][] = ['label' => 'Главная в Личном кабинете (вкладки)', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="lk-page-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
