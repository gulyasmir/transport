<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\IndividualAddress */

$this->title = $model->individual_address_id;
$this->params['breadcrumbs'][] = ['label' => 'Individual Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="individual-address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'individual_address_id' => $model->individual_address_id, 'address_id' => $model->address_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'individual_address_id' => $model->individual_address_id, 'address_id' => $model->address_id], [
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
            'individual_address_id',
            'address_id',
            'full_name',
            'country',
            'identification',
            'identification_series',
            'identification_number',
        ],
    ]) ?>

</div>
