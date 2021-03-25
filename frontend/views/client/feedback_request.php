<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Написать менеджеру по заказу '.$order->order_number;
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
                <div class="row">
                    <div class="col-12">
                        <?= $form->field($feedback_request, 'contact_person')->textInput(['placeholder' => $feedback_request->getAttributeLabel('contact_person'), 'class' => ''])->label(false) ?>
                        
                        <?= $form->field($feedback_request, 'phone')->textInput(['placeholder' => $feedback_request->getAttributeLabel('phone'), 'class' => ''])->label(false) ?>
                        
                        <?= $form->field($feedback_request, 'email')->textInput(['placeholder' => $feedback_request->getAttributeLabel('email'), 'class' => ''])->label(false) ?>
                        
                        <?= $form->field($feedback_request, 'title')->textInput(['placeholder' => $feedback_request->getAttributeLabel('title'), 'class' => ''])->label(false) ?>
                        
                        <?= $feedback_request->getAttributeLabel('comment') ?>:
                        <?= $form->field($feedback_request, 'comment')->textArea(['style' => 'resize:none;'])->label(false) ?>
                        
                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success upload-document-submit']) ?>
                        </div>
                    </div>
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
