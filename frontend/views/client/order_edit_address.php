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
        <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
        
        <div class="row form">
              <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>
            
            <div class="col-md-7 col-xs-12 client-info">
                <?php $form = ActiveForm::begin([
                    'id' => 'document-request-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>
                    
                    <?= $form->field($order_edit_address, 'address')->textInput(['placeholder' => $order_edit_address->getAttributeLabel('address'), 'class' => ''])->label(false) ?>
                    
                    <div class="form-group">
                        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success upload-document-submit']) ?>
                    </div>
                     
                <?php ActiveForm::end(); ?>
            </div>
            
           <div class="col-md-3 col-xs-12">
                <?php
                    echo $this->context->renderPartial('_menu_order', ['order' => $order]);
                ?>
            </div>
        </div>
    </div>
</section>
