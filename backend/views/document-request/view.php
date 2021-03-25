<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DocumentRequest */

$this->title = $model->feedback_request_id;
$this->params['breadcrumbs'][] = ['label' => 'Document Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="document-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'feedback_request_id' => $model->feedback_request_id, 'user_id' => $model->user_id, 'order_id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'feedback_request_id' => $model->feedback_request_id, 'user_id' => $model->user_id, 'order_id' => $model->order_id], [
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
            'feedback_request_id',
            'user_id',
            'order_id',
            'create_date',
            'date_from',
            'date_to',
            'contact_person',
            'phone',
            'email:email',
            'comment:ntext',
            'send_post',
            'send_email:email',
            'status',
        ],
    ]) ?>

</div>
