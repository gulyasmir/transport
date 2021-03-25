<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\jui\DatePicker

/* @var $this yii\web\View */
/* @var $model common\models\GeneralCargoOnePlace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="general-cargo-one-place-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo '<br>Пользователь: '.$model->order->user->username.'<br>';
        echo '<br>Дата создания: '.date('d.m.Y', $model->order->create_date).'<br><br>';
        //$form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::findAll(['role' => 1]), 'id', 'username'));
    ?>

    <?php // $form->field($model, 'from')->textInput(['maxlength' => true]) ?>
<?php  echo 'Откуда : <b>'. $model->order->from.' </b> <br><br>';?>
    <?= $form->field($model, 'city_pick_up', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->city_pick_up) ? (boolean)$model->city_pick_up : false), 'value' => '1'])?>

    <?php // $form->field($model, 'to')->textInput(['maxlength' => true]) ?>

    <?php  echo ' Куда :<b> '. $model->order->from.' </b><br> <br>';?>

    <?= $form->field($model, 'city_delivery', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->city_delivery) ? (boolean)$model->city_delivery : false), 'value' => '1'])?>

    <?php
          echo 'Расстояние <b> : '. $model->order->route_length.' км </b><br>';
          echo '<br>Расчетная цена доставки: <b>'. $model->order->calculated_price.' руб.</b><br><br>';
    ?>
      <?= $form->field($model, 'real_price')->textInput() ?>
      
    <?php //echo $form->field($model, 'is_draft', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->is_draft) ? (boolean)$model->is_draft : false), 'value' => '1']) ?>

    <?= $form->field($model, 'invoice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_of_departure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length')->textInput() ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'volume')->textInput() ?>

    <?= $form->field($model, 'cargo_params')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hazard_class')->textInput() ?>

    <?= $form->field($model, 'declared_price')->textInput() ?>


    <div style="margin-bottom: 30px;">
        <label class="control-label" for="pick_up_date"><?= $model->getAttributeLabel('pick_up_date') ?></label>
        <div>
        <?php
            if (!$model->pick_up_date) {
                $model->pick_up_date = date('d.m.Y', time());
            }
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'pick_up_date',
                'language' => 'ru',
                'dateFormat' => 'dd.MM.yyyy',
            ]);
        ?>
        </div>
    </div>

    <h4>Услуги при доставке от адреса</h4>
    <label><?= $model->getAttributeLabel('from_address_loading') ?></label>
    <?=
        $form->field($model,'from_address_loading')->radioList(\Yii::$app->params['from_address_loading'], [
           'separator'=>"<div></div>",
           'encode'=>'html',
           'id' => 'shipping-types-radio',
           'item' => function ($index, $label, $name, $checked, $value) {
               return '<label style="margin-left: 21px;" class="radio' . ($checked ? ' active' : '') . '">' .
                   Html::radio($name, $checked, ['value' => $value]) . $label .
                   '<span class="checkround"></span>'.
               '</label>';
           },
       ])->label(false)
    ?>

    <?= $form->field($model, 'loading_operations', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->loading_operations) ? (boolean)$model->loading_operations : false), 'value' => '1'])?>

    <?= $form->field($model, 'territory_entry', ['template'=>'{input}{label}'])->textInput(['class'=>"",'type'=>'checkbox', 'checked' => (isset($model->territory_entry) ? (boolean)$model->territory_entry : false), 'value' => '1'])?>

    <?=
        $form->field($model, 'status')->dropDownList(\Yii::$app->params['status']);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
