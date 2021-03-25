
<table>
    <tr>
        <td>
            <h2>Расчет - выделенный транспорт фура</h2>
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
    echo \Yii::$app->mailer->render('order/forms/_admin_form', ['user' => $user]);
?>

<?php
    echo \Yii::$app->mailer->render('order/forms/_dedicated_truck_form', ['model' => $model]);
?>
