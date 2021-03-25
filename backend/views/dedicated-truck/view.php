<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DedicatedTransportTruck */

$this->title = $model->dt_truck_id;
$this->params['breadcrumbs'][] = ['label' => 'Dedicated Transport Trucks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dedicated-transport-truck-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dt_truck_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dt_truck_id], [
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
            'dt_truck_id',
            'user_id',
            'semi_trailer_type',
            'tent_hard_board',
            'tent_removable_top_beam',
            'tent_removable_side_beam',
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
            'filling',
            'hard_package',
            'pallet_transparent',
            'pallet_black',
            'tent_remove_to',
            'tent_remove_from',
            'pallet_board_pack',
            'is_draft',
        ],
    ]) ?>

</div>
