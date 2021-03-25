<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Заказ '.$order->order_number;

$order_data = \Yii::$app->controller->get_order_data($order);

$sender = \Yii::$app->controller->get_address_data($order->sender);

$recipient = \Yii::$app->controller->get_address_data($order->recipient);

$payer = \Yii::$app->controller->get_address_data($order->payer);
?>

<section class="client-section">
    <div class="container">
       

        <div class="row">
              <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>

            <div class="col-md-7 col-xs-12 client-info">
            	
            	 <div class="block-with-frame"> 
            	  <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
                <div class="row">
                    <div class="col-6">
                        <div class="order-from-left">
                            <p><strong>Откуда:</strong><br> <?= $order->from ?>, <?= $order->sender->address ?></p>

                            <p>От кого: <?= $order->sender->contact_person ?></p>

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
                            <p><b>Куда:</b><br> <?= $order->to ?>, <?= $order->recipient->address ?></p>

                            <p>Кому: <?= $order->recipient->contact_person ?></p>

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
                                echo '<br><b>Плательщик</b>: Отпраивтель';
                            } elseif ($order->payer_id == $order->recipient_id) {
                                echo '<br><b>Плательщик:</b> Получатель';
                            }
                        ?><br><br>

                        <b><?= $order_data->getAttributeLabel('pick_up_date') ?>:</b> <?= date('d.m.Y', $order_data->pick_up_date) ?><br><br>

                        <?php
                            if (mb_stripos($order->order_number, 'СО-') !== false) {
                        ?>
                                <b>Габариты груза:</b> <?= $order_data->length ?>x<?= $order_data->width ?>x<?= $order_data->height ?><br><br>
                                <b><?= $order_data->getAttributeLabel('weight') ?>:</b> <?= $order_data->weight ?><br><br>
                                <b><?= $order_data->getAttributeLabel('volume') ?>:</b> <?= $order_data->volume ?><br><br>
                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br><br>
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
                                <b><?= $order_data->getAttributeLabel('place_quantity') ?>:</b> <?= $order_data->place_quantity ?><br><br>
                                <b><?= $order_data->getAttributeLabel('overall_volume') ?>:</b> <?= $order_data->overall_volume ?><br><br>
                                <b><?= $order_data->getAttributeLabel('overall_weight') ?>:</b> <?= $order_data->overall_weight ?><br><br>

                                <b><?= $order_data->getAttributeLabel('biggest_length') ?>:</b> <?= $order_data->biggest_length ?><br><br>
                                <b><?= $order_data->getAttributeLabel('biggest_width') ?>:</b> <?= $order_data->biggest_width ?><br><br>
                                <b><?= $order_data->getAttributeLabel('biggest_height') ?>:</b> <?= $order_data->biggest_height ?><br><br>
                                <b><?= $order_data->getAttributeLabel('biggest_weight') ?>:</b> <?= $order_data->biggest_weight ?><br><br>

                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br><br>
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
                                 <b>Габариты груза:</b> <?= $order_data->length ?>x<?= $order_data->width ?>x<?= $order_data->height ?><br><br>
                                <b><?= $order_data->getAttributeLabel('weight') ?>:</b> <?= $order_data->weight ?><br><br>
                                <b><?= $order_data->getAttributeLabel('volume') ?>:</b> <?= $order_data->volume ?><br><br>
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
                                        echo \Yii::$app->params['semi_trailer_type'][$order_data->semi_trailer_type].'<br><br>';

                                        if ($order_data->tent_hard_board) {
                                            echo $order_data->getAttributeLabel('tent_hard_board').'<br><br>';
                                        }
                                        if ($order_data->tent_removable_top_beam) {
                                            echo $order_data->getAttributeLabel('tent_removable_top_beam').'<br><br>';
                                        }
                                        if ($order_data->tent_removable_side_beam) {
                                            echo $order_data->getAttributeLabel('tent_removable_side_beam').'<br><br>';
                                        }
                                    }
                                ?><br>

                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br><br>
                                <b><?= $order_data->getAttributeLabel('cargo_params') ?>:</b> <?= $order_data->cargo_params ?><br><br>

                                <?php
                                    if ($order_data->from_address_loading) {
                                        echo \Yii::$app->params['from_address_loading'][$order_data->from_address_loading].'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->loading_operations) {
                                        echo $order_data->getAttributeLabel('loading_operations').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->territory_entry) {
                                        echo $order_data->getAttributeLabel('territory_entry').'<br><br>';
                                    }
                                ?><br>

                                <?php
                                    if ($order_data->filling) {
                                        echo $order_data->getAttributeLabel('filling').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->hard_package) {
                                        echo $order_data->getAttributeLabel('hard_package').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_transparent) {
                                        echo $order_data->getAttributeLabel('pallet_transparent').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_black) {
                                        echo $order_data->getAttributeLabel('pallet_black').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_to) {
                                        echo $order_data->getAttributeLabel('tent_remove_to').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_from) {
                                        echo $order_data->getAttributeLabel('tent_remove_from').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_board_pack) {
                                        echo $order_data->getAttributeLabel('pallet_board_pack').'<br><br>';
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

                                <b><?= $order_data->getAttributeLabel('hazard_class') ?>:</b> <?= $order_data->hazard_class ?><br><br>
                                <b><?= $order_data->getAttributeLabel('declared_price') ?>:</b> <?= $order_data->declared_price ?> руб.<br><br>
                                <b><?= $order_data->getAttributeLabel('cargo_params') ?>:</b> <?= $order_data->cargo_params ?><br><br>

                                <?php
                                    if ($order_data->from_address_loading) {
                                        echo \Yii::$app->params['from_address_loading'][$order_data->from_address_loading].'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->loading_operations) {
                                        echo $order_data->getAttributeLabel('loading_operations').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->territory_entry) {
                                        echo $order_data->getAttributeLabel('territory_entry').'<br><br>';
                                    }
                                ?><br>

                                <?php
                                    if ($order_data->filling) {
                                        echo $order_data->getAttributeLabel('filling').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->hard_package) {
                                        echo $order_data->getAttributeLabel('hard_package').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_transparent) {
                                        echo $order_data->getAttributeLabel('pallet_transparent').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_black) {
                                        echo $order_data->getAttributeLabel('pallet_black').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_to) {
                                        echo $order_data->getAttributeLabel('tent_remove_to').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->tent_remove_from) {
                                        echo $order_data->getAttributeLabel('tent_remove_from').'<br><br>';
                                    }
                                ?>
                                <?php
                                    if ($order_data->pallet_board_pack) {
                                        echo $order_data->getAttributeLabel('pallet_board_pack').'<br><br>';
                                    }
                                ?>
                        <?php
                            }
                        ?>
                        <br>
                   
                     	 <p><b>Статус заказа: </b>
                     	 <?php
                     	 
									switch ($order->status) {
										 case 0:
									        echo "Черновик";
									        break;
									    case 1:
									        echo "В обработке";
									        break;
									    case 2:
									        echo "Принят к перевозке";
									        break;
									    case 3:
									        echo "Вручен";
									        break;
									}
                     	 ?>
                     	 </p>
                     	 
                     	 
                        <br>
                     
                  
                       
                         <?php   if ($order->status > 0) {  ?>
                       <?php  if ($order->real_price > 0) {   ?>
                       <p style="font-size:110%"><b>Цена доставки: </b> <?=$order->real_price?> руб. </p>
                         <?php   }    else { ?>
                          <p style="font-size:110%"><b>Расчетная цена доставки: </b> <?=$order->calculated_price?> руб. </p>
                         <? } ?>
                         
                         <?php   } else { ?>
                          <p style="font-size:110%"><b>Расчетная цена доставки: </b> <?=$order->calculated_price?> руб. </p>
                           <br>   <br>  
                         	 <a href="/order/confirmation?order_id=<?=$order->order_id?>" class="btn btn-primary order-button-save btn-padding" >Оформить заказ </a>
                         <?php  }  ?>
                          
                            
                         
                         
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 order-documents">
                        <?php
                            if (count($order->documents)) {
                                echo '<div class="subtitle">Документы для перевозки</div>';
                                foreach($order->documents as $document) {
                                    echo '<p>'.Html::a($document->title, [\Yii::$app->params['documents_web_path'].'/'.$document->name], ['target' => '_blank']).'</p>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
</div>
            <div class="col-md-3 col-xs-12">
                <?php
                    echo $this->context->renderPartial('_menu_order', ['order' => $order]);
                ?>
            </div>
        </div>
    </div>
</section>
