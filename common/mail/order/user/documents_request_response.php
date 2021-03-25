
<table>
    <tr>
        <td>
            <h2>Запрос документов (выполнено)</h2>
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
    
    <tr>
        <td>
            <?= $model->response ?>
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
            <h3>Запрос:</h3>
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
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('date_from') ?>: <?= $model->date_from ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('date_to') ?>: <?= $model->date_to ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('send_post') ?>: <?= $model->send_post ? 'Да' : 'Нет' ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('send_email') ?>: <?= $model->send_email ? 'Да' : 'Нет' ?>
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

