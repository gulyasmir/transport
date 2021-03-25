<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FeedbackRequest */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Feedback Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="feedback-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'document_request_id' => $model->document_request_id, 'user_id' => $model->user_id, 'order_id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'document_request_id' => $model->document_request_id, 'user_id' => $model->user_id, 'order_id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'document_request_id',
            'user_id',
            'order_id',
            'create_date',
            'title',
            'comment:ntext',
            'phone',
            'email:email',
            'contact_person',
            'status',
        ],
    ]) ?>

</div>
