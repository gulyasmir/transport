<?php
use yii\helpers\Html;

$this->title = 'Личный кабинет';
?>

<section class="client-section">
    <div class="container">
       

        <div class="row">
            <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>

            <div class="col-md-9">
			<div class="block-with-frame">
				 <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
                <div class="client-tabs transport-mode">
                    <div class="col-12">
                        <div class="margin"></div>
                    </div>
                    <div class="col-lg-12">
                        <span class="ftr-logo">
                            <?= Html::button('Информация', ['id' => 'info-button', 'class' => 'transport-mode-tab selected', 'tab_content' => 'info']) ?>
                            <?= Html::button('Условия сотрудничества', ['id' => 'cooperation-button', 'class' => 'transport-mode-tab ', 'tab_content' => 'cooperation']) ?>
                            <?= Html::button('Справка', ['id' => 'reference-button', 'class' => 'transport-mode-tab ', 'tab_content' => 'cooperation']) ?>
                        </span>
                    </div>
                </div>

                <div class="info tab" style="display: block;">
                    <?php
                        echo $text_lk_page->text_info;
                    ?>
                </div>

                <div class="cooperation tab">
                    <?php
                    echo $text_lk_page->text_cooperation;
                    ?>
                </div>

                <div class="reference tab">
                    <?php
                      echo $text_lk_page->text_help;
                    ?>
                </div>
</div>
            </div>
        </div>
    </div>
</section>
