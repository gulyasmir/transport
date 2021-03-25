<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FeedbackRequest */

$this->title = 'Create Feedback Request';
$this->params['breadcrumbs'][] = ['label' => 'Feedback Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
