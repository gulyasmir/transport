<?php
use yii\helpers\Html;
use common\components\PhoneHelper;
?>

<table>
    <tr>
        <td>
            <h3>Пользователь:</h3>
        </td>
    </tr>
    <?php
        if ($user->username) {
    ?>
        <tr>
            <td>
                <?= $user->getAttributeLabel('username') ?>: <?= $user->username ?>
            </td>
        </tr>
    <?php } ?>
    <?php
        if ($user->name) {
    ?>
        <tr>
            <td>
                <?= $user->getAttributeLabel('name') ?>: <?= $user->name ?>
            </td>
        </tr>
    <?php } ?>
    <?php
        if ($user->surname) {
    ?>
        <tr>
            <td>
                <?= $user->getAttributeLabel('surname') ?>: <?= $user->surname ?>
            </td>
        </tr>
    <?php } ?>
    <?php
        if ($user->patronymic) {
    ?>
        <tr>
            <td>
                <?= $user->getAttributeLabel('patronymic') ?>: <?= $user->patronymic ?>
            </td>
        </tr>
    <?php } ?>
    <?php
        if ($user->phone) {
    ?>
        <tr>
            <td>
                <?= $user->getAttributeLabel('phone') ?>: <?= PhoneHelper::format_phone($user->phone) ?>
            </td>
        </tr>
    <?php } ?>
    <?php
        if ($user->inn) {
    ?>
        <tr>
            <td>
                <?= $user->getAttributeLabel('inn') ?>: <?= $user->inn ?>
            </td>
        </tr>
    <?php } ?>
    
    <tr>
        <td>
            <hr />
        </td>
    </tr>
</table>