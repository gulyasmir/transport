<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Сделать доставку до адреса для заказа '.$order->order_number;
?>

<section class="client-section">
    <div class="container">
        <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
        
        <div class="row form">
              <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>
            
            <div class="col-7 client-info">
                <?php $form = ActiveForm::begin([
                    'id' => 'document-request-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>
                    
                    <?= $form->field($order_edit_city_delivery, 'address')->textInput(['placeholder' => $order_edit_city_delivery->getAttributeLabel('address'), 'class' => ''])->label(false) ?>
                    
                    <?= $form->field($order_edit_city_delivery, 'city_delivery', ['template'=>'{input}{label}{error}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($order_edit_city_delivery->city_delivery) ? (boolean)$order_edit_city_delivery->city_delivery : false), 'value' => '1'])?>
                    
                     <div class="form-group">
                        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success upload-document-submit']) ?>
                    </div>
                     
                <?php ActiveForm::end(); ?>
            </div>
            
            <div class="col-3">
                <?php
                    echo $this->context->renderPartial('_menu_order', ['order' => $order]);
                ?>
            </div>
        </div>
    </div>
</section>
