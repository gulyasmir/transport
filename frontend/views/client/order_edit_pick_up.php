<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Приостановить выдачу груза для заказа '.$order->order_number;
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
                    <?= $order_edit_pick_up->getAttributeLabel('pick_up_date'); ?>:
                    <?= $form->field($order_edit_pick_up, 'pick_up_date')->widget(DatePicker::className(),[
                        'name' => 'pick_up_date',
                        'language' => 'ru-RU',
                        'dateFormat' => 'dd.MM.yyyy',
                        'clientOptions' => [
                           'showOn' => 'both',
                           'buttonImage' => Url::to('@web/img/datepicker.png'),
                           'buttonImageOnly' => true,
                           'buttonText' => '',
                         ],
                     ])->label(false) ?>
                     
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
