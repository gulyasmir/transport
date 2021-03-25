<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Изменить контактную информацию получателя для заказа '.$order->order_number;
?>

<section class="client-section">
    <div class="container">
     
        
        <div class="row form">
           <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>
            
            <div class="col-md-7 col-xs-12 client-info">
            		 <div class="block-with-frame"> 
            		    <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
                <?php $form = ActiveForm::begin([
                    'id' => 'document-request-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>
                    
                    <?= $form->field($order_edit_contacts, 'phone')->textInput(['placeholder' => $order_edit_contacts->getAttributeLabel('phone'), 'class' => ''])->label(false) ?>
                    
                    <?= $form->field($order_edit_contacts, 'contact_person')->textInput(['placeholder' => $order_edit_contacts->getAttributeLabel('contact_person'), 'class' => ''])->label(false) ?>
                    
                     <div class="form-group">
                        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success upload-document-submit']) ?>
                    </div>
                     
                <?php ActiveForm::end(); ?>
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
