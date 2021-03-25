<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use common\models\Article;
$article_hazard_class = Article::find()->where(['title'=>'Подробнее о классах опасности'])->one();
$article_price = Article::find()->where(['title'=>'Документальное подтверждение стоимости груза'])->one();
?>

<div class="from-to row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('from') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'from')->label(false) ?>
        <div class="from-checkbox">
            <?= $form->field($model, 'city_pick_up', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->city_pick_up) ? (boolean)$model->city_pick_up : false), 'value' => '1'])?>
        </div>
    </div>
    <div class="label to col-md-3">
        <label><?= $model->getAttributeLabel('to') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'to')->label(false) ?>
        <div class="to-checkbox">
            <?= $form->field($model, 'city_delivery', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->city_delivery) ? (boolean)$model->city_delivery : false), 'value' => '1'])?>
        </div>
    </div>
</div>

<div class="сargo-dimensions biggest-length row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('biggest_length') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'biggest_length')->textInput(['placeholder' => 'Длина, м', 'class' => 'calculate-biggest-length order-num'])->label(false) ?>
    </div>
</div>

<div class="сargo-dimensions biggest-width row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('biggest_width') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'biggest_width')->textInput(['placeholder' => 'Ширина, м', 'class' => 'calculate-biggest-width order-num'])->label(false) ?>
    </div>
</div>

<div class="сargo-dimensions biggest-height row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('biggest_height') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'biggest_height')->textInput(['placeholder' => 'Высота, м', 'class' => 'calculate-biggest-height order-num'])->label(false) ?>
    </div>
</div>

<div class="сargo-dimensions biggest-weight row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('biggest_weight') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'biggest_weight')->textInput(['placeholder' => 'Вес, кг', 'class' => 'calculate-biggest-weight order-num'])->label(false) ?>
    </div>
</div>

<div class="сargo-dimensions place-quantity row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('place_quantity') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'place_quantity')->textInput(['placeholder' => '2', 'class' => 'calculate-place-quantity order-num'])->label(false) ?>
    </div>
    <div class="col-md-3 link-block">
        <?= Html::a('Воспользоваться режимом 1 место', [''], ['id' => 'one-place-mode']) ?>
    </div>
</div>

<div class="сargo-dimensions overall-volume row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('overall_volume') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'overall_volume')->textInput(['placeholder' => 'Объем, м', 'class' => 'calculate-overall-volume order-num'])->label(false) ?>
    </div>
</div>

<div class="сargo-dimensions overall-weight row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('overall_weight') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'overall_weight')->textInput(['placeholder' => 'Вес, кг', 'class' => 'calculate-overall-weight order-num'])->label(false) ?>
    </div>
</div>

<div class="cargo-params row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('cargo_params') ?>:</label>
    </div>
    <div class="col-md-9">
        <?= $form->field($model, 'cargo_params')->textArea(['style' => 'resize:none;'])->label(false) ?>
    </div>
</div>

<div class="hazard-class row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('hazard_class') ?>:</label>
    </div>
    <div class="col-md-3">
        <?php
            //if (!$model->hazard_class) {
            //    $model->hazard_class = 0;
            //}
        ?>
        <?= $form->field($model, 'hazard_class')->textInput(['class' => 'order-num', 'placeholder' => '0'])->label(false) ?>
    </div>
  <div class="col-md-3 link-block">
  	
  		<a href="/site/articles/<?=$article_hazard_class->article_id?>" target="_blank"><?=$article_hazard_class->title?></a>
 
    </div>
</div>

<div class="declared-price row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('declared_price') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'declared_price')->textInput(['class' => 'order-num'])->label(false) ?>
    </div>
    <div class="col-md-4 text">
      Документально подтверждая стоимость груза.<br>
        	<a href="/site/articles/<?=$article_price->article_id?>" target="_blank">Кликните</a>
		, чтобы узнать подробнее.
    </div>
</div>

<div class="pickup-date row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('pick_up_date') ?>:</label>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'pick_up_date')->widget(DatePicker::className(),[
            'name' => 'pick_up_date',
            'language' => 'ru-RU',
            'dateFormat' => 'dd.MM.yyyy',
            'clientOptions' => [
               //'changeMonth' => true,
               //'changeYear' => true,
               //'yearRange' => date('Y').':2099',
               'showOn' => 'both',
               'buttonImage' => Url::to('@web/img/datepicker.png'),
               'buttonImageOnly' => true,
               'buttonText' => '',
             ],
         ])->label(false) ?>
    </div>
</div>

<h2 class="section-subtitle">Услуги при доставке от адреса</h2>
<div class="row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="col-md-3">
        <?=
            $form->field($model,'from_address_loading')->radioList(\Yii::$app->params['from_address_loading'], [
               'separator'=>"<div></div>",
               'encode'=>'html',
               'id' => 'shipping-types-radio',
               'item' => function ($index, $label, $name, $checked, $value) {
                   return '<label class="radio' . ($checked ? ' active' : '') . '">' .
                       Html::radio($name, $checked, ['value' => $value]) . $label .
                       '<span class="checkround"></span>'.
                   '</label>';
               },
           ])->label(false)
       ?>
    </div>
    <div class="territory-loading col-md-4">
        <div class="loading-checkbox">
            <?= $form->field($model, 'loading_operations', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->loading_operations) ? (boolean)$model->loading_operations : false), 'value' => '1'])?>
        </div>
        <div class="territory-checkbox">
            <?= $form->field($model, 'territory_entry', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->territory_entry) ? (boolean)$model->territory_entry : false), 'value' => '1'])?>
        </div>
    </div>
</div>
