
<table>
    <tr>
        <td>
            <h2>Редактирование адреса получателя</h2>
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
            <h3>Изменено:</h3>
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('address') ?>: <?= $model->address ?>
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

