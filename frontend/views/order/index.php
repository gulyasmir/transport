<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\LegalForm;

$this->title = 'Расчет заказа';

// Not safe cookies for tabs & subtabs
$order_tab = 'cargo';
$order_subtab_cargo = 'one';
$order_subtab_dedicated = 'truck';
if (isset($_COOKIE['order_tab'])) {
    $order_tab = trim($_COOKIE['order_tab']);
}
if (isset($_COOKIE['order_subtab_cargo'])) {
    $order_subtab_cargo = trim($_COOKIE['order_subtab_cargo']);
}
if (isset($_COOKIE['order_subtab_dedicated'])) {
    $order_subtab_dedicated = trim($_COOKIE['order_subtab_dedicated']);
}


?>

<section class="order-section">
    <div class="container">
        <h1 class="section-title"><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'order-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
        ]); ?>

            <div class="types">

                <div class="transport-mode row no-gutters">
                    <div class="col-12">
                        <div class="margin"></div>
                    </div>
                    <div class="label col-lg-2 col-xl-2">
                        <span class="ftr-logo">
                            <label>Способ перевозки:</label>
                        </span>
                    </div>
                    <div class="col-lg-6">
                        <span class="ftr-logo">

                            <?= Html::hiddenInput('main_tab', $order_tab, ['id' => 'main-tab-hidden']) ?>
                            <?= Html::button('Сборный груз', ['id' => 'cargo-button', 'class' => 'transport-mode-tab '.(($order_tab == 'cargo') ? 'selected' : ''), 'tab_content' => 'cargo']) ?>
                            <?= Html::button('Выделенный транспорт', ['id' => 'dedicated-button', 'class' => 'transport-mode-tab '.(($order_tab == 'dedicated') ? 'selected' : ''), 'tab_content' => 'dedicated']) ?>
                        </span>
                    </div>
                </div>

                <div class="dedicated tab" <?php if ($order_tab == 'dedicated') echo 'style="display: block;"'; ?>>

                    <div class="shipping-types row no-gutters">
                        <div class="col-12">
                            <div class="margin"></div>
                        </div>
                        <div class="label col-lg-2 col-xl-2">
                            <span class="ftr-logo">
                                <label>Перевозка:</label>
                            </span>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="radio">
                                <?=
                                     Html::radioList('shipping_types', 'truck', \Yii::$app->params['shipping_types'], [
                                        'separator'=>"<div></div>",
                                        'encode'=>'html',
                                        'id' => 'shipping-types-radio',
                                        'item' => function ($index, $label, $name, $checked, $value) {
                                            $checked = false;
                                            $order_subtab_dedicated = 'truck';
                                            if (isset($_COOKIE['order_subtab_dedicated'])) {
                                                $order_subtab_dedicated = trim($_COOKIE['order_subtab_dedicated']);
                                            }
                                            $checked = false;
                                            if ($value == $order_subtab_dedicated) {
                                                $checked = true;
                                            }
                                            return '<label class="radio' . ($checked ? ' active' : '') . '">' .
                                                Html::radio($name, $checked, ['value' => $value]) . $label .
                                                '<span class="checkround"></span>'.
                                            '</label>';
                                        },
                                    ])
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="truck subtab" <?php if ($order_subtab_dedicated == 'truck') echo 'style="display: block;"'; ?>>
                        <?php
                            echo $this->context->renderPartial('transport/_truck', ['model' => $truck_model, 'form' => $form]);
                        ?>
                    </div>
                    <div class="car subtab" <?php if ($order_subtab_dedicated == 'car') echo 'style="display: block;"'; ?>>
                        <?php
                            echo $this->context->renderPartial('transport/_car', ['model' => $car_model, 'form' => $form]);
                        ?>
                    </div>
                </div>

                <div class="cargo tab" <?php if ($order_tab == 'cargo') echo 'style="display: block;"'; ?>>

                    <div class="cargo-composition row no-gutters">
                        <div class="col-12">
                            <div class="margin"></div>
                        </div>
                        <div class="label col-lg-2 col-xl-2">
                            <span class="ftr-logo">
                                <label>Состав груза:</label>
                            </span>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="">
                                <?php
                                    echo Html::radioList('cargo_composition', 'one', \Yii::$app->params['cargo_composition'], [
                                        'separator'=>"<div></div>",
                                        'encode'=>'html',
                                        'id' => 'cargo-composition-radio',
                                        'item' => function ($index, $label, $name, $checked, $value) {
                                            $checked = false;
                                            $order_subtab_cargo = 'one';
                                            if (isset($_COOKIE['order_subtab_cargo'])) {
                                                $order_subtab_cargo = trim($_COOKIE['order_subtab_cargo']);
                                            }
                                            $checked = false;
                                            if ($value == $order_subtab_cargo) {
                                                $checked = true;
                                            }
                                            return '<label class="radio' . ($checked ? ' active' : '') . '">' .
                                                Html::radio($name, $checked, ['value' => $value]) . $label .
                                                '<span class="checkround"></span>'.
                                            '</label>';
                                        },
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="one subtab" <?php if ($order_subtab_cargo == 'one') echo 'style="display: block;"'; ?>>
                        <?php
                            echo $this->context->renderPartial('cargo/_one', ['model' => $one_model, 'form' => $form]);
                        ?>
                    </div>
                    <div class="many subtab" <?php if ($order_subtab_cargo == 'many') echo 'style="display: block;"'; ?>>
                        <?php
                            echo $this->context->renderPartial('cargo/_many', ['model' => $many_model, 'form' => $form]);
                        ?>
                    </div>
                    <div class="letter subtab" <?php if ($order_subtab_cargo == 'letter') echo 'style="display: block;"'; ?>>
                        <?php
                            echo $this->context->renderPartial('cargo/_letter', ['model' => $letter_model, 'form' => $form]);
                        ?>
                    </div>
                </div>



                <!-- Отправитель -->
                <h2 class="section-subtitle">Отправитель</h2>
                <div class="individual-entity-sender">
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="margin"></div>
                        </div>
                        <div class="col-lg-10">
                            <?=
                                $form->field($sender_model,'individual_entity')->radioList(\Yii::$app->params['sender_individual_entity'], [
                                   'separator'=>"<div></div>",
                                   'encode'=>'html',
                                   'id' => 'individual-entity-radio-sender',
                                   'item' => function ($index, $label, $name, $checked, $value) {

                                        return '<label id="individual-entity-radio-sender-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                            Html::radio($name, $checked, ['value' => $value]) . $label .
                                            '<span class="checkround"></span>'.
                                        '</label>';
                                   },
                               ])->label(false)
                            ?>
                        </div>
                    </div>
                    <div class="subtab individual individual-sender">
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'individual_full_name')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_full_name'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'individual_contact_person')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_contact_person'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'individual_country')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_country'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-12">
                                <?=
                                    $form->field($sender_model,'individual_identification')->radioList(\Yii::$app->params['identification'], [
                                       'separator'=>"<div></div>",
                                       'encode'=>'html',
                                       'id' => 'sender-identification-radio',
                                       'item' => function ($index, $label, $name, $checked, $value) {

                                            return '<label id="sender-identification-radio-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                                Html::radio($name, $checked, ['value' => $value]) . $label .
                                                '<span class="checkround"></span>'.
                                            '</label>';
                                       },
                                   ])->label(false)
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($sender_model, 'individual_identification_series')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_identification_series'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($sender_model, 'individual_identification_number')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_identification_number'), 'class' => ''])->label(false) ?>
                            </div>

                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'individual_identification_uvd')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_identification_uvd'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($sender_model, 'individual_identification_date')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_identification_date'), 'class' => ''])->label(false) ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'individual_phone')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_phone'), 'class' => ''])->label(false) ?>
                                <?= $form->field($sender_model, 'individual_address')->textInput(['placeholder' => $sender_model->getAttributeLabel('individual_address'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="subtab entity entity-sender" <?= (isset($sender_model->individual_entity) && $sender_model->individual_entity != 'address-sender') ? 'style="display:block;"' : ''; ?>>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'entity_name')->textInput(['placeholder' => $sender_model->getAttributeLabel('entity_name'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($sender_model, 'entity_country')->textInput(['placeholder' => $sender_model->getAttributeLabel('entity_country'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($sender_model, 'entity_inn')->textInput(['placeholder' => $sender_model->getAttributeLabel('entity_inn'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($sender_model, 'entity_kpp')->textInput(['placeholder' => $sender_model->getAttributeLabel('entity_kpp'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'entity_contact_person')->textInput(['placeholder' => $sender_model->getAttributeLabel('entity_contact_person'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'entity_phone')->textInput(['placeholder' => $sender_model->getAttributeLabel('entity_phone'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($sender_model, 'entity_address')->textInput(['placeholder' => $sender_model->getAttributeLabel('entity_address'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-9">
                                <?=
                                    $form->field($sender_model,'entity_legal_form_id')->radioList(ArrayHelper::map(LegalForm::find()->all(), 'legal_form_id', 'name'), [
                                       'separator'=>"<div></div>",
                                       'encode'=>'html',
                                       'unselect' => null,
                                       'id' => 'sender-entity-legal-form-radio',
                                       'item' => function ($index, $label, $name, $checked, $value) {

                                            return '<label id="sender-entity-legal-form-radio-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                                Html::radio($name, $checked, ['value' => $value]) . $label .
                                                '<span class="checkround"></span>'.
                                            '</label>';
                                       },
                                   ])->label(false)
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="subtab address address-sender" <?= (isset($sender_model->individual_entity) && $sender_model->individual_entity == 'address-sender') ? 'style="display:block;"' : ''; ?>>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-12">
                                <?php
                                    if (count($sender_address_list)) {
                                ?>
                                    <?=
                                        $form->field($sender_model,'address_id')->radioList($sender_address_list, [
                                           'separator'=>"<div></div>",
                                           'encode'=>'html',
                                           'unselect' => null,
                                           'id' => 'address-id-sender',
                                           'item' => function ($index, $label, $name, $checked, $value) {

                                                return '<label id="address-id-sender-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                                    Html::radio($name, $checked, ['value' => $value]) . $label .
                                                    '<span class="checkround"></span>'.
                                                '</label>';
                                           },
                                       ])->label(false)
                                    ?>
                                <?php
                                    } else {
                                        echo 'Нет сохраненных адресов.';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Получатель -->
                <h2 class="section-subtitle">Получатель</h2>
                <div class="individual-entity-recipient">
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="margin"></div>
                        </div>
                        <div class="col-lg-10">
                            <?=
                                $form->field($recipient_model,'individual_entity')->radioList(\Yii::$app->params['recipient_individual_entity'], [
                                   'separator'=>"<div></div>",
                                   'encode'=>'html',
                                   'unselect' => null,
                                   'id' => 'individual-entity-radio-recipient',
                                   'item' => function ($index, $label, $name, $checked, $value) {

                                        return '<label id="individual-entity-radio-recipient-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                            Html::radio($name, $checked, ['value' => $value]) . $label .
                                            '<span class="checkround"></span>'.
                                        '</label>';
                                   },
                               ])->label(false)
                            ?>
                        </div>
                    </div>
                    <div class="subtab individual individual-recipient">
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'individual_full_name')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_full_name'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'individual_contact_person')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_contact_person'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'individual_country')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_country'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-12">
                                <?=
                                    $form->field($recipient_model,'individual_identification')->radioList(\Yii::$app->params['identification'], [
                                       'separator'=>"<div></div>",
                                       'encode'=>'html',
                                       'unselect' => null,
                                       'id' => 'recipient-identification-radio',
                                       'item' => function ($index, $label, $name, $checked, $value) {

                                            return '<label id="recipient-identification-radio-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                                Html::radio($name, $checked, ['value' => $value]) . $label .
                                                '<span class="checkround"></span>'.
                                            '</label>';
                                       },
                                   ])->label(false)
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($recipient_model, 'individual_identification_series')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_identification_series'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($recipient_model, 'individual_identification_number')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_identification_number'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'individual_identification_uvd')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_identification_uvd'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($recipient_model, 'individual_identification_date')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_identification_date'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'individual_phone')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_phone'), 'class' => ''])->label(false) ?>
                                <?= $form->field($recipient_model, 'individual_address')->textInput(['placeholder' => $recipient_model->getAttributeLabel('individual_address'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="subtab entity entity-recipient" <?= (isset($recipient_model->individual_entity) && $recipient_model->individual_entity != 'address-recipient') ? 'style="display:block;"' : ''; ?>>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'entity_name')->textInput(['placeholder' => $recipient_model->getAttributeLabel('entity_name'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($recipient_model, 'entity_country')->textInput(['placeholder' => $recipient_model->getAttributeLabel('entity_country'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($recipient_model, 'entity_inn')->textInput(['placeholder' => $recipient_model->getAttributeLabel('entity_inn'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($recipient_model, 'entity_kpp')->textInput(['placeholder' => $recipient_model->getAttributeLabel('entity_kpp'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'entity_contact_person')->textInput(['placeholder' => $recipient_model->getAttributeLabel('entity_contact_person'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'entity_phone')->textInput(['placeholder' => $recipient_model->getAttributeLabel('entity_phone'), 'class' => ''])->label(false) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($recipient_model, 'entity_address')->textInput(['placeholder' => $recipient_model->getAttributeLabel('entity_address'), 'class' => ''])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-9">
                                <?=
                                    $form->field($recipient_model,'entity_legal_form_id')->radioList(ArrayHelper::map(LegalForm::find()->all(), 'legal_form_id', 'name'), [
                                       'separator'=>"<div></div>",
                                       'encode'=>'html',
                                       'unselect' => null,
                                       'id' => 'recipient-entity-legal-form-radio',
                                       'item' => function ($index, $label, $name, $checked, $value) {

                                            return '<label id="recipient-entity-legal-form-radio-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                                Html::radio($name, $checked, ['value' => $value]) . $label .
                                                '<span class="checkround"></span>'.
                                            '</label>';
                                       },
                                   ])->label(false)
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="subtab address address-recipient" <?= (isset($recipient_model->individual_entity) && $recipient_model->individual_entity == 'address-recipient') ? 'style="display:block;"' : ''; ?>>
                        <div class="row">
                            <div class="col-12">
                                <div class="margin"></div>
                            </div>
                            <div class="col-md-12">
                                <?php
                                    if (count($recipient_address_list)) {
                                ?>
                                    <?=
                                        $form->field($recipient_model,'address_id')->radioList($recipient_address_list, [
                                           'separator'=>"<div></div>",
                                           'encode'=>'html',
                                           'unselect' => null,
                                           'id' => 'address-id-recipient',
                                           'item' => function ($index, $label, $name, $checked, $value) {

                                                return '<label id="address-id-recipient-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                                    Html::radio($name, $checked, ['value' => $value]) . $label .
                                                    '<span class="checkround"></span>'.
                                                '</label>';
                                           },
                                       ])->label(false)
                                    ?>
                                <?php
                                    } else {
                                        echo 'Нет сохраненных адресов.';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Плательщик -->
                <h2 class="section-subtitle">Плательщик</h2>
                <div class="individual-entity">
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="margin"></div>
                        </div>
                        <div class="col-lg-10">
                            <?=
                                $form->field($payer_model,'sender_or_recipient')->radioList(\Yii::$app->params['payers'], [
                                   'separator'=>"<div></div>",
                                   'encode'=>'html',
                                   'unselect' => null,
                                   'id' => 'payer-form-radio',
                                   'item' => function ($index, $label, $name, $checked, $value) {

                                        return '<label id="payer-form-radio-'.$index.'" class="radio' . ($checked ? ' active' : '') . '">' .
                                            Html::radio($name, $checked, ['value' => $value]) . $label .
                                            '<span class="checkround"></span>'.
                                        '</label>';
                                   },
                               ])->label(false)
                            ?>
                        </div>
                    </div>
                </div>

                <div class="buttons-row row no-gutters">
                    <div class="col-12">
                        <div class="margin"></div>
                    </div>
                    <div class="col-lg-7">
                        <span class="ftr-logo">
                        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary order-button-save', 'name' => 'save_order']) ?>
                        <?= Html::submitButton('Сохранить черновик', ['class' => 'btn btn-primary order-button-draft', 'name' => 'draft_order']) ?>
                    </div>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>
