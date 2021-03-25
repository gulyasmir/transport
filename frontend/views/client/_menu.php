<?php
use frontend\assets\AppAsset;
AppAsset::register($this);

?> 
<ul class="nav lk_left_menu">
    <li <?php if ($this->context->route == 'client/profile') { ?>  class="active" <?php } ?>><a href="/client/profile">Мой профиль</a></li>
    <li <?php if ($this->context->route == 'client/orders') { ?>  class="active" <?php } ?>><a href="/client/orders">Мои заказы</a></li>
    <li <?php if ($this->context->route == 'client/addresses') { ?>  class="active" <?php } ?>><a href="/client/addresses">Адресная книга</a></li>
     <li><a href="/order">Калькулятор</a></li>
    <!--<li><a href="/client/documents">Документы</a></li>
    <li><a href="/client/feedback">Обратная связь</a></li>-->
</ul>
