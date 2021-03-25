<?php
return [

    // Email админа
    'adminEmail' => 'gulyasmir@yandex.ru',
    'supportEmail' => 'gulyasmir@yandex.ru',

    // От кого email
    'fromEmail' =>'gulyasmir@yandex.ru',

    // От кого имя
    'fromName' => 'Админ',

    // Параметры писем
    'email' => [

        // Даные писем админа
        'admin' => [

            // Сборный груз одно место
            'cargo_one' => [
                'subject' => 'Расчет заказа - сборный груз одно место',
                'template' => 'order/admin/cargo_one',
            ],
            // Сборный груз несколько мест
            'cargo_many' => [
                'subject' => 'Расчет заказа - сборный груз несколько мест',
                'template' => 'order/admin/cargo_many',
            ],
            // Сборный груз несколько мест
            'cargo_letter' => [
                'subject' => 'Расчет заказа - сборный груз письмо',
                'template' => 'order/admin/cargo_letter',
            ],
            // Выделенный транспорт фура
            'dedicated_truck' => [
                'subject' => 'Расчет заказа - выделенный транспорт фура',
                'template' => 'order/admin/dedicated_truck',
            ],
            // Выделенный транспорт машина
            'dedicated_car' => [
                'subject' => 'Расчет заказа - выделенный транспорт машина',
                'template' => 'order/admin/dedicated_car',
            ],

            // Обратная связь по заказу
            'feedback_request' => [
                'subject' => 'Обратная связь по заказу',
                'template' => 'order/admin/feedback_request',
            ],

            // Запрос документов по заказу
            'documents_request' => [
                'subject' => 'Запрос документов по заказу',
                'template' => 'order/admin/documents_request',
            ],

            // Загружен документ к заказу
            'uploaded_document' => [
                'subject' => 'Загружен документ к заказу',
                'template' => 'order/admin/uploaded_document',
            ],

            // Изменены контактные данные заказа
            'edit_contacts' => [
                'subject' => 'Изменены контактные данные получателя заказа',
                'template' => 'order/admin/edit_contacts',
            ],

            // Изменен адрес доставки заказа
            'edit_address' => [
                'subject' => 'Изменен адрес доставки заказа',
                'template' => 'order/admin/edit_address',
            ],

            // Изменена дата забора груза
            'edit_pick_up_date' => [
                'subject' => 'Изменена дата забора груза',
                'template' => 'order/admin/edit_pick_up_date',
            ],

            // Cделана доставка до адреса
            'edit_city_delivery' => [
                'subject' => 'Cделана доставка до адреса',
                'template' => 'order/admin/edit_city_delivery',
            ],
        ],

        // Даные писем пользователя
        'user' => [

            // Сборный груз одно место
            'cargo_one' => [
                'subject' => 'Расчет заказа - сборный груз одно место',
                'template' => 'order/user/cargo_one',
            ],
            // Сборный груз несколько мест
            'cargo_many' => [
                'subject' => 'Расчет заказа - сборный груз несколько мест',
                'template' => 'order/user/cargo_many',
            ],
            // Сборный груз несколько мест
            'cargo_letter' => [
                'subject' => 'Расчет заказа - сборный груз письмо',
                'template' => 'order/user/cargo_letter',
            ],
            // Выделенный транспорт фура
            'dedicated_truck' => [
                'subject' => 'Расчет заказа - выделенный транспорт фура',
                'template' => 'order/user/dedicated_truck',
            ],
            // Выделенный транспорт машина
            'dedicated_car' => [
                'subject' => 'Расчет заказа - выделенный транспорт машина',
                'template' => 'order/user/dedicated_car',
            ],

            // Обратная связь по заказу
            'feedback_request' => [
                'subject' => 'Обратная связь по заказу',
                'template' => 'order/user/feedback_request',
            ],

            // Запрос документов по заказу
            'documents_request' => [
                'subject' => 'Запрос документов по заказу',
                'template' => 'order/user/documents_request',
            ],

            // Загружен документ к заказу
            'uploaded_document' => [
                'subject' => 'Загружен документ к заказу',
                'template' => 'order/user/uploaded_document',
            ],

            // Изменены контактные данные заказа
            'edit_contacts' => [
                'subject' => 'Изменены контактные данные получателя заказа',
                'template' => 'order/user/edit_contacts',
            ],

            // Изменен адрес доставки заказа
            'edit_address' => [
                'subject' => 'Изменен адрес доставки заказа',
                'template' => 'order/user/edit_address',
            ],

            // Изменена дата забора груза
            'edit_pick_up_date' => [
                'subject' => 'Изменена дата забора груза',
                'template' => 'order/user/edit_pick_up_date',
            ],

            // Cделана доставка до адреса
            'edit_city_delivery' => [
                'subject' => 'Cделана доставка до адреса',
                'template' => 'order/user/edit_city_delivery',
            ],

            // Обратная связь по заказу ответ админа
            'feedback_request_response' => [
                'subject' => 'Обратная связь по заказу (ответ)',
                'template' => 'order/user/feedback_request_response',
            ],

            // // Запрос документов по заказу ответ админа
            'documents_request_response' => [
                'subject' => 'Запрос документов по заказу (выполнено)',
                'template' => 'order/user/documents_request_response',
            ],
        ],
    ],

    // Пути к изображениям статей и новостей
    'articles_full_path' => \Yii::getAlias('@frontend/web').'/images/article',
    'articles_http_path' => '/frontend/web/images/article',
    'articles_web_path' => '@web/images/article',

    'news_full_path' => \Yii::getAlias('@frontend/web').'/images/news',
    'news_http_path' => '/frontend/web/images/news',
    'news_web_path' => '@web/images/news',

    // Пути к файлам документов заказов
    'documents_full_path' => \Yii::getAlias('@frontend/web').'/documents',
    'documents_http_path' => '/frontend/web/documents',
    'documents_web_path' => '@web/documents',

    // Количество элементов на странице новостей
    'news_per_page' => 4,

    // Количество элементов на странице статей
    'articles_per_page' => 6,

    // Префиксы аказов
    'order_prefix' => [
        'one' => 'СО-', // Сборный груз одно место
        'many' => 'СМ-', // Сборный груз несколько мест
        'letter' => 'СП-', // Сборный груз письмо
        'truck' => 'ВФ-', // Выделенный транспорт фура
        'car' => 'ВМ-', // Выделенный транспорт машина
    ],

    'article_view' => [
        0 => 'Нет',
        1 => 'На главной (блоки)',
        2 => 'На главной (вкладки)',
        3 => 'В футере (услуги)',
        4 => 'В футере (клиентам)',
    ],

    'role' => [
        10 => 'Админ',
        1 => 'Пользователь',
    ],

    'cargo_composition' => [
        'one' => '1 место',
        'many' => 'Несколько мест',
        'letter' => 'Письмо',
    ],

    'shipping_types' => [
        'truck' => 'Фурой',
        'car' => 'Выделенной машиной',
    ],

    'sender_individual_entity' => [
        'entity-sender' => 'Юр. лицо',
        'individual-sender' => 'Физ. лицо',
        'address-sender' => 'Выбрать из ранее используемых адресов',
    ],

    'recipient_individual_entity' => [
        'entity-recipient' => 'Юр. лицо',
        'individual-recipient' => 'Физ. лицо',
        'address-recipient' => 'Выбрать из ранее используемых адресов',
    ],

    'load_capacity' => [
        1 => 'До 1,5 тонн, 15 м<sup><small>3</small></sup>',
        2 => 'До 4 тонн, 27 м<sup><small>3</small></sup>',
        3 => 'До 10 тонн, 35 м<sup><small>3</small></sup>',
    ],

    'hazard_class' => [
        1 => '1 класс',
        2 => '2 класс',
        3 => '3 класс',
        4 => '4 класс',
    ],

    'from_address_loading' => [
        1 => 'Верхняя загрузка',
        2 => 'Боковая загрузка',
        3 => 'Задняя загрузка',
    ],

    'semi_trailer_type' => [
        1 => 'Тентовый',
        2 => 'Изотермический',
    ],

    'identification' => [
        1 => 'Паспорт',
        2 => 'Загран. паспорт',
        3 => 'Водительское удостоверение',
    ],

    'payers' => [
        1 => 'Отправитель',
        2 => 'Получатель',
    ],

    'uploader' => [
        1 => 'Пользователь',
        2 => 'Админ',
    ],

    'status' => [
    	 0 => 'Черновик',
        1 => 'В обработке',
        2 => 'Принят к перевозке',
        3 => 'Вручен',
    ],

    'requests_status' => [
        1 => 'Активен',
        2 => 'Завершен',
    ],

    'user.passwordResetTokenExpire' => 3600,
];
