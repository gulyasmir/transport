
<table>
    <tr>
        <td>
            <h2>Расчет - сборный груз письмо</h2>
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
    echo \Yii::$app->mailer->render('order/forms/_cargo_letter_form', ['model' => $model]);
?>
