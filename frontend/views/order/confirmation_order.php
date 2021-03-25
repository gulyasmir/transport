<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\assets\MapClassAsset ;
/*....................*/
MapClassAsset::register($this);

$this->title = 'Подтверждение заказа '.$order->order_number;

$order_data = \Yii::$app->controller->get_order_data($order);

$sender = \Yii::$app->controller->get_address_data($order->sender);

$recipient = \Yii::$app->controller->get_address_data($order->recipient);

$payer = \Yii::$app->controller->get_address_data($order->payer);


//$this->registerJsFile('/js/map.js');
?>

<section class="order-section">
    <div class="container">
        <h1 class="section-title"><?= Html::encode($this->title) ?> </h1>
<script>
var var_from = "<?= $order->from ?>";
var var_to = "<?= $order->to ?>";
var rate = "<?=$rate->delivery_tariff?>";
var minimum = "<?=$rate->minimum_cost?>";
var constant = "<?=$rate->constant?>";
var order = "<?= $order->order_id ?>";
</script>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 client-info order-confirm">
                <div class="row">
                    <div class="col-6">
                        <div class="order-from-left">
                            <p><strong>Откуда:</strong><br> <?= $order->from ?></p>

                            <p>От кого: <?= $order->sender->contact_person ?></p>

                        <!--    <p>Данные отправителя: <?= $order->sender->address ?></p>-->

                            <p>Тел.: <?= $order->sender->phone ?></p>
                            <?php
                                if ($order_data->city_pick_up) {
                            ?>
                                    <p>Забрать с адреса</p>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="order-to-right">
                            <p><b>Куда:</b><br> <?= $order->to ?></p>

                            <p>Кому: <?= $order->recipient->contact_person ?></p>

                          <!--  <p>Данные получателя: <?= $order->recipient->address ?></p>-->

                            <p>Тел.: <?= $order->recipient->phone ?></p>

                            <?php
                                if ($order_data->city_delivery) {
                            ?>
                                    <p>Доставка до адреса</p>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 order-params">

                        <?php
                            if ($order->payer_id == $order->sender_id) {
                                echo '<br><b>Плательщик</b>: Отправитель';
                            } elseif ($order->payer_id == $order->recipient_id) {
                                echo '<br><b>Плательщик:</b> Получатель';
                            }
                        ?><br><br>

                        <b><?= $order_data->getAttributeLabel('pick_up_date') ?>:</b> <?= date('d.m.Y', $order_data->pick_up_date) ?><br><br>

                        <?php
                            if (mb_stripos($order->order_number, 'СО-') !== false) {
                        ?>
                                <b>Габариты груза:</b> <?= $order_data->length ?>x<?= $order_data->width ?>x<?= $order_data->height ?><br>
                                <b><?= $order_data->getAttributeLabel('weight') ?>:</b> <?= $order_data->weight ?><br>
                                <b><?= $order_data->getAttributeLabel('volume') ?>:</b> <?= $order_data->volume ?><br>
                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br>
                                <b><?= $order_data->getAttributeLabel('cargo_params') ?>:</b> <?= $order_data->cargo_params ?><br><br>

                                <?php
                                    if ($order_data->from_address_loading) {
                                        echo \Yii::$app->params['from_address_loading'][$order_data->from_address_loading];
                                    }
                                ?><br>
                                <?php
                                    if ($order_data->loading_operations) {
                                        echo $order_data->getAttributeLabel('loading_operations');
                                    }
                                ?><br>
                                <?php
                                    if ($order_data->territory_entry) {
                                        echo $order_data->getAttributeLabel('territory_entry');
                                    }
                                ?><br>
                        <?php
                            } elseif (mb_stripos($order->order_number, 'СМ-') !== false) {
                        ?>
                                <b><?= $order_data->getAttributeLabel('place_quantity') ?>:</b> <?= $order_data->place_quantity ?><br>
                                <b><?= $order_data->getAttributeLabel('overall_volume') ?>:</b> <?= $order_data->overall_volume ?><br>
                                <b><?= $order_data->getAttributeLabel('overall_weight') ?>:</b> <?= $order_data->overall_weight ?><br><br>

                                <b><?= $order_data->getAttributeLabel('biggest_length') ?>:</b> <?= $order_data->biggest_length ?><br>
                                <b><?= $order_data->getAttributeLabel('biggest_width') ?>:</b> <?= $order_data->biggest_width ?><br>
                                <b><?= $order_data->getAttributeLabel('biggest_height') ?>:</b> <?= $order_data->biggest_height ?><br>
                                <b><?= $order_data->getAttributeLabel('biggest_weight') ?>:</b> <?= $order_data->biggest_weight ?><br><br>

                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br>
                                <b><?= $order_data->getAttributeLabel('cargo_params') ?>:</b> <?= $order_data->cargo_params ?><br><br>

                                <?php
                                    if ($order_data->from_address_loading) {
                                        echo \Yii::$app->params['from_address_loading'][$order_data->from_address_loading];
                                    }
                                ?><br>
                                <?php
                                    if ($order_data->loading_operations) {
                                        echo $order_data->getAttributeLabel('loading_operations');
                                    }
                                ?><br>
                                <?php
                                    if ($order_data->territory_entry) {
                                        echo $order_data->getAttributeLabel('territory_entry');
                                    }
                                ?><br>
                        <?php
                            } elseif (mb_stripos($order->order_number, 'СП-') !== false) {
                        ?>
                                 <b>Габариты груза:</b> <?= $order_data->length ?>x<?= $order_data->width ?>x<?= $order_data->height ?><br>
                                <b><?= $order_data->getAttributeLabel('weight') ?>:</b> <?= $order_data->weight ?><br>
                                <b><?= $order_data->getAttributeLabel('volume') ?>:</b> <?= $order_data->volume ?><br>
                                <b><?= $order_data->getAttributeLabel('cargo_params') ?>:</b> <?= $order_data->cargo_params ?><br><br>

                                <?php
                                    if ($order_data->territory_entry) {
                                        echo $order_data->getAttributeLabel('territory_entry');
                                    }
                                ?><br>
                        <?php
                            } elseif (mb_stripos($order->order_number, 'ВФ-') !== false) {
                        ?>
                                <?php
                                    if ($order_data->semi_trailer_type) {
                                        echo '<b>'.$order_data->getAttributeLabel('semi_trailer_type').':</b> ';
                                        echo \Yii::$app->params['semi_trailer_type'][$order_data->semi_trailer_type].'<br>';

                                        if ($order_data->tent_hard_board) {
                                            echo $order_data->getAttributeLabel('tent_hard_board').'<br>';
                                        }
                                        if ($order_data->tent_removable_top_beam) {
                                            echo $order_data->getAttributeLabel('tent_removable_top_beam').'<br>';
                                        }
                                        if ($order_data->tent_removable_side_beam) {
                                            echo $order_data->getAttributeLabel('tent_removable_side_beam').'<br>';
                                        }
                                    }
                                ?><br>

                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br>
                                <b><?= $order_data->getAttributeLabel('cargo_params') ?>:</b> <?= $order_data->cargo_params ?><br><br>

                                <?php
                                    if ($order_data->from_address_loading) {
                                        echo \Yii::$app->params['from_address_loading'][$order_data->from_address_loading].'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->loading_operations) {
                                        echo $order_data->getAttributeLabel('loading_operations').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->territory_entry) {
                                        echo $order_data->getAttributeLabel('territory_entry').'<br>';
                                    }
                                ?><br>

                                <?php
                                    if ($order_data->filling) {
                                        echo $order_data->getAttributeLabel('filling').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->hard_package) {
                                        echo $order_data->getAttributeLabel('hard_package').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_transparent) {
                                        echo $order_data->getAttributeLabel('pallet_transparent').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_black) {
                                        echo $order_data->getAttributeLabel('pallet_black').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_to) {
                                        echo $order_data->getAttributeLabel('tent_remove_to').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_from) {
                                        echo $order_data->getAttributeLabel('tent_remove_from').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_board_pack) {
                                        echo $order_data->getAttributeLabel('pallet_board_pack').'<br>';
                                    }
                                ?>
                        <?php
                            } elseif (mb_stripos($order->order_number, 'ВМ-') !== false) {
                        ?>
                                <?php
                                    if ($order_data->load_capacity) {
                                        echo '<b>'.$order_data->getAttributeLabel('load_capacity').':</b> ';
                                        echo \Yii::$app->params['load_capacity'][$order_data->load_capacity].'<br><br>';
                                    }
                                ?>

                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br>
                                <b><?= $order_data->getAttributeLabel('cargo_params') ?>:</b> <?= $order_data->cargo_params ?><br><br>

                                <?php
                                    if ($order_data->from_address_loading) {
                                        echo \Yii::$app->params['from_address_loading'][$order_data->from_address_loading].'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->loading_operations) {
                                        echo $order_data->getAttributeLabel('loading_operations').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->territory_entry) {
                                        echo $order_data->getAttributeLabel('territory_entry').'<br>';
                                    }
                                ?><br>

                                <?php
                                    if ($order_data->filling) {
                                        echo $order_data->getAttributeLabel('filling').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->hard_package) {
                                        echo $order_data->getAttributeLabel('hard_package').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_transparent) {
                                        echo $order_data->getAttributeLabel('pallet_transparent').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_black) {
                                        echo $order_data->getAttributeLabel('pallet_black').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_to) {
                                        echo $order_data->getAttributeLabel('tent_remove_to').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_from) {
                                        echo $order_data->getAttributeLabel('tent_remove_from').'<br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_board_pack) {
                                        echo $order_data->getAttributeLabel('pallet_board_pack').'<br>';
                                    }
                                ?>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
          <div class="col-3"></div>
          <div class="col-9">
              <div id="price-order-map" style="width: 100%; height: 100px"></div>
          </div>
        </div>
        <div class="confirm-buttons-row row no-gutters">
            <div class="col-12">
                <div class="margin"></div>
            </div>
            <div class="col-3"></div>
            <div class="col-lg-6">

                <span class="ftr-logo">
                <?php $form = ActiveForm::begin([
                    'id' => 'order-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>
                    <?= $form->field($terms, 'terms', ['template'=>'{input}{label}{error}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->terms) ? (boolean)$model->terms : true), 'value' => '1'])?>

                    <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary order-button-save', 'name' => 'confirm_order']) ?>
                    <?= Html::submitButton('Отмена', ['class' => 'btn btn-primary order-button-draft', 'name' => 'decline_order']) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-3"></div>
        </div>
      <div class="row">
    <div class="col-12">
      <div id="map" style="width: 100%; height: 400px"></div>
    </div>
      </div>
</div>

</section>
