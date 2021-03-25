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
                    <td width="130">
                        Длина:
                    </td>
                    <td>
                        <?= $model->length ?> см
                    </td>
                </tr>
                <tr>
                    <td width="130">
                        Высота:
                    </td>
                    <td>
                        <?= $model->height ?> см
                    </td>
                </tr>
                <tr>
                    <td width="130">
                        Ширина:
                    </td>
                    <td>
                        <?= $model->width ?> см
                    </td>
                </tr>
                <tr>
                    <td width="130">
                        Вес:
                    </td>
                    <td>
                        <?= $model->weight ?> кг
                    </td>
                </tr>
                <tr>
                    <td width="130">
                        Объем:
                    </td>
                    <td>
                        <?= $model->volume ?> м<small><sup>3</sup></small>
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
            <?= $model->getAttributeLabel('territory_entry') ?>: <?= $model->territory_entry ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
</table>
