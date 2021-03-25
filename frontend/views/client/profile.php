<?php
use yii\helpers\Html;

$this->title = 'Мой профиль';
?>

<section class="client-section">
    <div class="container">
     
        
        <div class="row">
            <div class="col-xs-12 col-md-2">
                <?php
                    echo $this->context->renderPartial('_menu');
                ?>
            </div>
            
            <div class="col-md-9 client-info">
               <div class="block-with-frame">  
                  <h1 class="section-title"><?= Html::encode($this->title) ?></h1>
                <p>ФИО: <?= $customer['name']; ?> <?= $customer['surname']; ?> <?= $customer['patronymic']; ?></p>
                <p>Телефон: <?= $customer['phone']; ?></p>
                <p>Email: <?= $customer['email']; ?></p>
                <p>ИНН: <?= $customer['inn']; ?></p>
            </div>
             </div>
        </div>
    </div>
</section>
