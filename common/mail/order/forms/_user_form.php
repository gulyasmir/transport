
<?php
use yii\helpers\Html;
use common\components\PhoneHelper;
?>

<table>
    <tr>
        <td>
            <h3>Контакты:</h3>
        </td>
    </tr>
    <?php
        if ($contacts->phone) {
    ?>
        <tr>
            <td>
                <?= $contacts->getAttributeLabel('phone') ?>: <?= PhoneHelper::format_phone($contacts->phone) ?>
            </td>
        </tr>
    <?php } ?>
    <?php
        if ($contacts->email) {
    ?>
        <tr>
            <td>
                <?= $contacts->getAttributeLabel('email') ?>: <?= $contacts->email ?>
            </td>
        </tr>
    <?php } ?>
    <?php
        if ($contacts->address) {
    ?>
        <tr>
            <td>
                <?= $contacts->getAttributeLabel('address') ?>: <?= $contacts->address ?>
            </td>
        </tr>
    <?php } ?>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
</table>