<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FeedbackRequest */

$this->title = 'Редактирование заявки (обратная связь) #' . $model->feedback_request_id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
