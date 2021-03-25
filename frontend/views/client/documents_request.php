<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\DatePicker;

$this->title = 'Предоставить документы за период по заказу '.$order->order_number;
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
                    'id' => 'document-request-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>
                <div class="row">
                    <div class="col-6">
                        <?= $document_request->getAttributeLabel('date_from'); ?>:
                        <?= $form->field($document_request, 'date_from')->widget(DatePicker::className(),[
                            'name' => 'date_from',
                            'language' => 'ru-RU',
                            'dateFormat' => 'dd.MM.yyyy',
                            'clientOptions' => [
                               'showOn' => 'both',
                               'buttonImage' => Url::to('@web/img/datepicker.png'),
                               'buttonImageOnly' => true,
                               'buttonText' => '',
                             ],
                         ])->label(false) ?>
                    </div>
                    <div class="col-6">
                            <?= $document_request->getAttributeLabel('date_to'); ?>:
                        <?= $form->field($document_request, 'date_to')->widget(DatePicker::className(),[
                            'name' => 'date_to',
                            'language' => 'ru-RU',
                            'dateFormat' => 'dd.MM.yyyy',
                            'clientOptions' => [
                               'showOn' => 'both',
                               'buttonImage' => Url::to('@web/img/datepicker.png'),
                               'buttonImageOnly' => true,
                               'buttonText' => '',
                             ],
                         ])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?= $form->field($document_request, 'contact_person')->textInput(['placeholder' => $document_request->getAttributeLabel('contact_person'), 'class' => ''])->label(false) ?>

                        <?= $form->field($document_request, 'phone')->textInput(['placeholder' => $document_request->getAttributeLabel('phone'), 'class' => ''])->label(false) ?>

                        <?= $form->field($document_request, 'email')->textInput(['placeholder' => $document_request->getAttributeLabel('email'), 'class' => ''])->label(false) ?>

                        <?= $document_request->getAttributeLabel('comment') ?>:
                        <?= $form->field($document_request, 'comment')->textArea(['style' => 'resize:none;'])->label(' (Пожалуйста, укажите, какие документы нужны)') ?>

                        <div class="send-post-checkbox">
                            <?= $form->field($document_request, 'send_post', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($document_request->send_post) ? (boolean)$document_request->send_post : false), 'value' => '1'])?>
                        </div>

                        <?= $form->field($document_request, 'post_adress')->textarea(['rows' => 6, 'readonly' => false]) ?>

                        <div class="send-email-checkbox">
                            <?= $form->field($document_request, 'send_email', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($document_request->send_email) ? (boolean)$document_request->send_email : false), 'value' => '1'])?>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Запросить', ['class' => 'btn btn-success upload-document-submit']) ?>
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
