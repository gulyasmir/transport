
<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\CalculationForm;
use frontend\models\SearchForm;
?>

<div class="hdr-mid">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8">
                 <!--   <div class="stock">
                <p class="stock__title title">
                        Акции:
                    </p>
                    <ul class="stock__list">
                        <li>
                            <a href="#">
                                <img src="<?= Url::to('@web/img/truck-active.png') ?>" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?= Url::to('@web/img/truck.png') ?>" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="<?= Url::to('@web/img/shipping-active.png') ?>" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <?php
                    $search_model = new SearchForm();
                    $search_form = ActiveForm::begin(['id' => 'search-form',
                        'method'=>'post',
                        'action' => \Yii::$app->urlManager->createAbsoluteUrl('client/orders'),
                        'options' => [
                            'class' => 'tracking'
                        ]
                    ]);
                ?>
                    <p class="tracking__title title">
                      <a href="/client/orders" style="color:#ffffff">Где мой груз?</a>
                    </p>-->
                  <?php  $search_form->field($search_model, 'tracking_number')->textInput(['placeholder' => $search_model->getAttributeLabel('tracking_number'), 'class' => 'tracking__input'])->label(false) ?>
                   <?php  Html::submitButton('_', ['id' => 'search-button', 'name' => 'search_submit']) ?>
               <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-5 col-lg-4 d-flex justify-content-md-center align-items-md-center">
                <?php
                    $calculation_model = new CalculationForm();
                    $calculation_form = ActiveForm::begin(['id' => 'calculation-form',
                        'method'=>'post',
                        'action' => \Yii::$app->urlManager->createAbsoluteUrl('order/index'),
                        'options' => [
                            'class' => 'calculation'
                        ]
                    ]);
                ?>
                    <p class="calculation__title title">Рассчет заказа</p>

                    <?= $calculation_form->field($calculation_model, 'from')->textInput(['placeholder' => $calculation_model->getAttributeLabel('from'), 'class' => 'calculation__input'])->label(false) ?>
                    <div class="check-wrap">
                        <?= $calculation_form->field($calculation_model, 'city_pick_up', ['template'=>'{input}{label}'])->textInput(['class' => 'calculation__checkbox', 'id' => 'pickup', 'type' => 'checkbox', 'value' => '1'])->label($calculation_model->getAttributeLabel('city_pick_up'), ['class' => 'calculation__text'])?>
                    </div>

                    <?= $calculation_form->field($calculation_model, 'to')->textInput(['placeholder' => $calculation_model->getAttributeLabel('to'), 'class' => 'calculation__input'])->label(false) ?>
                    <div class="check-wrap .check-wrap2">
                        <?= $calculation_form->field($calculation_model, 'city_delivery', ['template'=>'{input}{label}'])->textInput(['class' => 'calculation__checkbox', 'id' => 'delivery', 'type' => 'checkbox', 'value' => '1'])->label($calculation_model->getAttributeLabel('city_delivery'), ['class' => 'calculation__text'])?>
                    </div>

                    <?= Html::submitButton('Рассчитать', ['class' => 'calculation__calck', 'id' => 'calculating-button', 'name' => 'calculating_submit']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="hdr-bot">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-4">
                <a href="<?= \Yii::$app->urlManager->createAbsoluteUrl('order/index') ?>" class="service">
                    <img src="<?= Url::to('@web/img/calculator2.png') ?>" alt="Рассчитать" class="service__icon">
                    <p class="service__title title">
                        Рассчитать доставку
                    </p>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/client/orders" class="service">
                    <img src="<?= Url::to('@web/img/search-box2.png') ?>" alt="Рассчитать" class="service__icon">
                    <p class="service__title title">
                        Отследить груз
                    </p>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/site/contact" class="service service_last">
                    <img src="<?= Url::to('@web/img/location2.png') ?>" alt="Рассчитать" class="service__icon">
                    <p class="service__title title">
                        Представительства
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>
