<?php
use yii\helpers\Html;
?>

<table>
    <tr>
        <td>
            <h3>Направление:</h3>
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('from') ?>: <?= $model->from ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('city_pick_up') ?>: <?= $model->city_pick_up ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('to') ?>: <?= $model->to ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('city_delivery') ?>: <?= $model->city_delivery ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <h3><?= $model->getAttributeLabel('semi_trailer_type') ?>: </h3>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('semi_trailer_type') ?>: 
            <?php if ($model->semi_trailer_type) { ?>
                <?= \Yii::$app->params['semi_trailer_type'][$model->semi_trailer_type] ?>
            <?php } else { ?>
                Нет
            <?php } ?>
        </td>
    </tr>
    <?php if ($model->semi_trailer_type == 1) { ?>
        <tr>
            <td>
                <?= $model->getAttributeLabel('tent_hard_board') ?>: <?= $model->tent_hard_board ? 'Да' : 'Нет' ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $model->getAttributeLabel('tent_removable_top_beam') ?>: <?= $model->tent_removable_top_beam ? 'Да' : 'Нет' ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $model->getAttributeLabel('tent_removable_side_beam') ?>: <?= $model->tent_removable_side_beam ? 'Да' : 'Нет' ?>
            </td>
        </tr>
    <?php } ?>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <h3>Информация:</h3>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('cargo_params') ?>: <?= $model->cargo_params ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('hazard_class') ?>: <?= $model->hazard_class ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('declared_price') ?>: <?= $model->declared_price ?> руб
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('pick_up_date') ?>: <?= date('d.m.Y', $model->pick_up_date) ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <h3>Услуги при доставке от адреса:</h3>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('from_address_loading') ?>: 
            <?php if ($model->from_address_loading) { ?>
                <?= \Yii::$app->params['from_address_loading'][$model->from_address_loading] ?>
            <?php } else { ?>
                Нет
            <?php } ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('loading_operations') ?>: <?= $model->loading_operations ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('territory_entry') ?>: <?= $model->territory_entry ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <h3>Дополнительные услуги:</h3>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('filling') ?>: <?= $model->filling ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('hard_package') ?>: <?= $model->hard_package ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('pallet_transparent') ?>: <?= $model->pallet_transparent ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('pallet_black') ?>: <?= $model->pallet_black ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('tent_remove_to') ?>: <?= $model->tent_remove_to ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('tent_remove_from') ?>: <?= $model->tent_remove_from ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('pallet_board_pack') ?>: <?= $model->pallet_board_pack ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
</table>
