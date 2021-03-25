<?php
return [
    'dashboard' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'customer' => [
        'type' => 1,
        'description' => 'Покупатель',
        'ruleName' => 'userRole',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'userRole',
    ],
];
