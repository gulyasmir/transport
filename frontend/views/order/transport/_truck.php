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

<div class="semi-trailer-type row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="label">
        <label><?= $model->getAttributeLabel('semi_trailer_type') ?>:</label>
    </div>
    <div class="col-md-3">
        <?php
            \Yii::$app->controller->view->params['model'] = $model;
            \Yii::$app->controller->view->params['form'] = $form;

            if (!$model->semi_trailer_type) {
                $model->semi_trailer_type = 1;
            }
        ?>
        <?=
            $form->field($model,'semi_trailer_type')->radioList(\Yii::$app->params['semi_trailer_type'], [
               'separator'=>"<div></div>",
               'encode'=>'html',
               'id' => 'shipping-types-radio',
               'item' => function ($index, $label, $name, $checked, $value) {
                    $model = \Yii::$app->controller->view->params['model'];
                    $form = \Yii::$app->controller->view->params['form'];
                    $content = '';
                    if (!$index) {
                        $content = '<div class="tent" '.(($model->semi_trailer_type == 2) ? 'style="display:none;"' : '').'>'.
                            $form->field($model, 'tent_hard_board', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->tent_hard_board) ? (boolean)$model->tent_hard_board : false), 'value' => '1']).
                            $form->field($model, 'tent_removable_top_beam', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->tent_removable_top_beam) ? (boolean)$model->tent_removable_top_beam : false), 'value' => '1']).
                            $form->field($model, 'tent_removable_side_beam', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->tent_removable_side_beam) ? (boolean)$model->tent_removable_side_beam : false), 'value' => '1']).
                        '</div>';
                    }
                    return '<label id="shipping-radio-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                        Html::radio($name, $checked, ['value' => $value]) . $label .
                        '<span class="checkround"></span>'.
                    '</label>'.$content;
               },
           ])->label(false)
       ?>
        <?= Html::error($model, 'semi_trailer_type', ['class' => 'error']) ?>
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

<h2 class="section-subtitle">Дополнительные услуги</h2>
<div class="additional-services row no-gutters">
    <div class="col-12">
        <div class="margin"></div>
    </div>
    <div class="filling col-md-4">
        <div class="filling-checkbox row-checkbox">
            <?= $form->field($model, 'filling', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->filling) ? (boolean)$model->filling : false), 'value' => '1'])?>
        </div>
        <div class="hard-package-checkbox row-checkbox">
            <?= $form->field($model, 'hard_package', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->hard_package) ? (boolean)$model->hard_package : false), 'value' => '1'])?>
        </div>
        <div class="pallet-transparent-checkbox row-checkbox">
            <?= $form->field($model, 'pallet_transparent', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->pallet_transparent) ? (boolean)$model->pallet_transparent : false), 'value' => '1'])?>
        </div>
        <div class="pallet-black-checkbox row-checkbox">
            <?= $form->field($model, 'pallet_black', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->pallet_black) ? (boolean)$model->pallet_black : false), 'value' => '1'])?>
        </div>
        <div class="tent-remove-to-checkbox row-checkbox">
            <?= $form->field($model, 'tent_remove_to', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->tent_remove_to) ? (boolean)$model->tent_remove_to : false), 'value' => '1'])?>
        </div>
        <div class="tent-remove-from-checkbox row-checkbox">
            <?= $form->field($model, 'tent_remove_from', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->tent_remove_from) ? (boolean)$model->tent_remove_from : false), 'value' => '1'])?>
        </div>
        <div class="pallet-board-pack-checkbox row-checkbox">
            <?= $form->field($model, 'pallet_board_pack', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->pallet_board_pack) ? (boolean)$model->pallet_board_pack : false), 'value' => '1'])?>
        </div>
    </div>
</div>
