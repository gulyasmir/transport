<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralCargoOnePlace */

$this->title = $model->gc_one_place_id;
$this->params['breadcrumbs'][] = ['label' => 'General Cargo One Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="general-cargo-one-place-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gc_one_place_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gc_one_place_id], [
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
            'gc_one_place_id',
            'user_id',
            'length',
            'width',
            'height',
            'weight',
            'volume',
            'cargo_params',
            'hazard_class',
            'declared_price',
            'from',
            'to',
            'city_pick_up',
            'city_delivery',
            'pick_up_date',
            'from_address_loading',
            'loading_operations',
            'territory_entry',
            'is_draft',
        ],
    ]) ?>

</div>
