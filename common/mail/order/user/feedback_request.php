
<table>
    <tr>
        <td>
            <h2>Обратная связь</h2>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            Заказ № <?= $order->order_number ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
</table>

<table>
    <tr>
        <td>
            <h3>Информация:</h3>
        </td>
    </tr>
        
    <tr>
        <td>
            <?= $model->getAttributeLabel('contact_person') ?>: <?= $model->contact_person ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('phone') ?>: <?= $model->phone ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('email') ?>: <?= $model->email ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('title') ?>: <?= $model->title ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $model->getAttributeLabel('comment') ?>: <?= $model->comment ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
</table>

<?php
    echo \Yii::$app->mailer->render('order/forms/_user_form', ['contacts' => $contacts]);
?>

