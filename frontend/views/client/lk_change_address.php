<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Изменить адрес доставки для заказа '.$order->order_number;
?>

<section class="client-section">
    <div class="container">
       

        <div class="row form">
               <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>

            <div class="col-md-7 col-xs-12  client-info">
            		 <div class="block-with-frame"> 
            		  <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
            <?=$text_lk_change->text  ?>
            <hr>
            <a href="<?=$text_lk_change->pdf?>" target="_blank">Образец заявления на изменения адреса доставки</a>

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
