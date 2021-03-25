<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DocumentRequest */

$this->title = 'Редактирование заявки (запрос доументов) #' . $model->document_request_id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки запрос документов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
