<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GeneralCargoManyPlaces */

$this->title = $model->gc_many_places_id;
$this->params['breadcrumbs'][] = ['label' => 'General Cargo Many Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="general-cargo-many-places-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->gc_many_places_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->gc_many_places_id], [
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
            'gc_many_places_id',
            'user_id',
            'biggest_length',
            'biggest_width',
            'biggest_height',
            'place_quantity',
            'overall_volume',
            'overall_weight',
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
