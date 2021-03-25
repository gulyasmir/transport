<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DocumentRequest */

$this->title = 'Create Document Request';
$this->params['breadcrumbs'][] = ['label' => 'Document Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
