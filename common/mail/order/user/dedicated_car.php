
<table>
    <tr>
        <td>
            <h2>Расчет - выделенный транспорт машина</h2>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
    
    <tr>
        <td>
            Заказ № <?= $model->order->order_number ?>
        </td>
    </tr>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
</table>

<?php
    echo \Yii::$app->mailer->render('order/forms/_dedicated_car_form', ['model' => $model]);
?>

<?php
    echo \Yii::$app->mailer->render('order/forms/_user_form', ['contacts' => $contacts]);
?>