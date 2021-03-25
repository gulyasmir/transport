<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<table>
    <tr>
        <td>
            <h2>Загружен документ к заказу</h2>
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
            <h3>Файл документа:</h3>
        </td>
    </tr>
    
    <tr>
        <td>
            <?= $model->getAttributeLabel('title') ?>: <?= $model->title ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= str_replace('frontend/web/', '', \Yii::$app->urlManager->createAbsoluteUrl(\Yii::$app->params['documents_http_path'].'/'.$model->name)) ?>
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

