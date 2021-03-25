<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Загрузить документ к заказу '.$order->order_number;
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
                <?php $form = ActiveForm::begin([
                    'id' => 'upload-document-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                ]); ?>
                    <?= $form->field($document, 'title')->textInput(['placeholder' => $document->getAttributeLabel('title')])->label(false) ?><br>
                    
                    <?= $form->field($document, 'name')->fileInput()->label('Документ:') ?>
                    
                    <div class="form-group">
                        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success upload-document-submit']) ?>
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
