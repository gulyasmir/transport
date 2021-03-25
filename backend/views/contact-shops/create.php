<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContactShops */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Адреса  на карте', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-shops-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
