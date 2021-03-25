<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EntityAddress */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Entity Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entity-address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'entity_address_id' => $model->entity_address_id, 'address_id' => $model->address_id, 'legal_form_id' => $model->legal_form_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'entity_address_id' => $model->entity_address_id, 'address_id' => $model->address_id, 'legal_form_id' => $model->legal_form_id], [
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
            'entity_address_id',
            'address_id',
            'legal_form_id',
            'name',
            'country',
            'inn',
            'kpp'
        ],
    ]) ?>

</div>
