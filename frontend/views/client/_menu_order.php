
<ul class="nav lk_left_menu">
    <li <?php if ($this->context->route == 'client/feedback-request') { ?>  class="active" <?php } ?>><a href="/client/feedback-request?order_id=<?= $order->order_id ?>">Написать менеджеру</a></li>
    <li <?php if ($this->context->route == 'client/upload-document') { ?>  class="active" <?php } ?>><a href="/client/upload-document?order_id=<?= $order->order_id ?>">Загрузить документ</a></li>
    <li <?php if ($this->context->route == 'client/documents-request') { ?>  class="active" <?php } ?>><a href="/client/documents-request?order_id=<?= $order->order_id ?>">Запросить документы за период</a></li>
    <?php
        if ($order->status == 1 || $order->status == 2) {
    ?>
            <li <?php if ($this->context->route == 'client/order-edit-contacts') { ?>  class="active" <?php } ?>><a href="/client/order-edit-contacts?order_id=<?= $order->order_id ?>">Изменить контактную информацию</a></li>
            <!--
            <li><a href="/client/order-edit-address?order_id=<?= $order->order_id ?>">Изменить адрес доставки</a></li>
            <li><a href="/client/order-edit-pick-up?order_id=<?= $order->order_id ?>">Приостановить выдачу груза получателем</a></li>
            <li><a href="/client/order-edit-city-delivery?order_id=<?= $order->order_id ?>">Заказать доставку до адреса</a></li>
          -->
  <li <?php if ($this->context->route == 'client/lk-change-address') { ?>  class="active" <?php } ?>><a href="/client/lk-change-address?order_id=<?= $order->order_id ?>">Изменить адрес доставки</a></li>
  <li <?php if ($this->context->route == 'client/lk-change-pick-up') { ?>  class="active" <?php } ?>><a href="/client/lk-change-pick-up?order_id=<?= $order->order_id ?>">Приостановить выдачу груза получателем</a></li>
  <li <?php if ($this->context->route == 'client/lk-change-city-delivery') { ?>  class="active" <?php } ?>><a href="/client/lk-change-city-delivery?order_id=<?= $order->order_id ?>">Заказать доставку до адреса</a></li>

    <?php
        }
    ?>
</ul>
