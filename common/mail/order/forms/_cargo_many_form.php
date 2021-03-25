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
            <h3>Габариты груза:</h3>
        </td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td width="180">
                        <?= $model->getAttributeLabel('biggest_length') ?>:
                    </td>
                    <td>
                        <?= $model->biggest_length ?> см
                    </td>
                </tr>
                <tr>
                    <td width="180">
                        <?= $model->getAttributeLabel('biggest_width') ?>:
                    </td>
                    <td>
                        <?= $model->biggest_width ?> см
                    </td>
                </tr>
                <tr>
                    <td width="180">
                        <?= $model->getAttributeLabel('biggest_height') ?>:
                    </td>
                    <td>
                        <?= $model->biggest_height ?> см
                    </td>
                </tr>
                <tr>
                    <td width="180">
                        <?= $model->getAttributeLabel('biggest_weight') ?>:
                    </td>
                    <td>
                        <?= $model->biggest_weight ?> кг
                    </td>
                </tr>
                <tr>
                    <td width="180">
                        <?= $model->getAttributeLabel('place_quantity') ?>:
                    </td>
                    <td>
                        <?= $model->place_quantity ?>
                    </td>
                </tr>
                <tr>
                    <td width="180">
                        <?= $model->getAttributeLabel('overall_volume') ?>:
                    </td>
                    <td>
                        <?= $model->overall_volume ?> м<small><sup>3</sup></small>
                    </td>
                </tr>
                <tr>
                    <td width="180">
                        <?= $model->getAttributeLabel('overall_weight') ?>:
                    </td>
                    <td>
                        <?= $model->overall_weight ?> кг
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
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
</table>
