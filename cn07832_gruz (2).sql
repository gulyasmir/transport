-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 25 2021 г., 17:52
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cn07832_gruz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `t_address`
--

CREATE TABLE IF NOT EXISTS `t_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL,
  `create_date` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `type` int(11) DEFAULT NULL COMMENT 'Отправитель или получатель',
  `address` varchar(1000) DEFAULT NULL COMMENT 'Адрес',
  `contact_person` varchar(500) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`address_id`,`user_id`),
  KEY `fk_t_adress_t_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_address`
--

INSERT INTO `t_address` (`address_id`, `user_id`, `create_date`, `type`, `address`, `contact_person`, `phone`) VALUES
(9, 2, 1560989613, 1, 'Казань ул Бутлерова 99', 'Имя2 Фамилия2', '89503245582'),
(10, 2, 1560989613, 2, 'Москва ул Светлая 6', 'Аникин Василий Михайлович', '89503245582'),
(16, 2, 1562005186, 2, 'Москва ул Светлая 6', 'Аникин 5 6', '+799999999'),
(17, 2, 1562005866, 2, 'Москва ул Светлая 666', 'Аникин 5 6', '+799999999'),
(18, 2, 1562005952, 2, 'Москва ул Светлая 611', 'Аникин 5 6', '+799999999'),
(19, 2, 1562037917, 2, 'Москва ул Светлая 611', 'Аникин 5 6', '+799999999'),
(20, 2, 1562037974, 2, 'Москва ул Светлая 6999', 'Аникин 5 6', '+799999999'),
(21, 10, 1562101604, 1, 'москва', 'иван', '111111'),
(22, 10, 1562101604, 2, 'калинингрд', 'иван', '111112'),
(23, 10, 1562101778, 1, '1111', 'иванов', '111'),
(24, 10, 1562101778, 2, '1111', '1111', '1111'),
(26, 10, 1562138093, 1, 'ролвсрль', 'лврловр', '678467878'),
(27, 10, 1562138093, 2, 'рлсапрл', 'нвоенолне', '888'),
(28, 10, 1562142894, 1, 'fbdfbdfbf', 'rtyertyer', '8878'),
(29, 10, 1562142894, 2, 'gthsh', '4545y4', '5656356'),
(30, 10, 1562142961, 2, '67467', '4545y4', '5656356'),
(31, 10, 1562143227, 2, '67467', 'цукуцк', '43442'),
(32, 10, 1562143285, 2, 'новый адрес', 'цукуцк', '43442'),
(33, 10, 1562143300, 2, 'новый адрес', 'цукуцк', '43442'),
(34, 2, 1563359492, 1, 'адрес отправки', 'вася', '67465'),
(35, 2, 1563359492, 2, 'адрес получателя', 'вася11', '111112'),
(36, 12, 1563378938, 1, 'Российская Федерация, 127560, МОСКВА Г, УЛ ПЛЕЩЕЕВА, дом 30, кв. 50', 'ДРЯБЕЗГОВ КОНСТАНТИН МИХАЙЛОВИЧ', '89257109036'),
(37, 12, 1563378938, 2, 'Российская Федерация, 127560, МОСКВА Г, УЛ ПЛЕЩЕЕВА, дом 30, кв. 50', 'ДРЯБЕЗГОВ КОНСТАНТИН МИХАЙЛОВИЧ', '89257109036'),
(40, 1, 1563448012, 1, 'мытищи', 'Дмитрий', '89257109036'),
(41, 1, 1563448012, 2, 'Мытищи', 'Николай', '89257109036'),
(42, 1, 1563448664, 1, 'мытищи', 'Дмитрий', '89257109036'),
(43, 1, 1563448664, 2, 'Мытищи', 'Николай', '89257109036'),
(44, 13, 1563948778, 1, 'пвыпвпввп', 'ымпвамвам', '5787787'),
(45, 13, 1563948778, 2, 'рарарпар', 'пвапвап', '58587'),
(49, 2, 1567168886, 1, 'ролвсрль', 'лврловр', '58787856'),
(51, 2, 1567171087, 1, 'олпрол', 'Вася', '788786787'),
(57, 2, 1567172878, 1, 'Карасево', 'иван', '786868'),
(58, 2, 1567172878, 2, 'адрес получателя', 'иван', '111112'),
(59, 2, 1567175687, 1, 'Москва кл Шапошникова 12-34б', 'Василий Петрович', '58787856'),
(60, 2, 1567175687, 2, 'адрес получателя', 'иван', '111112'),
(61, 2, 1567175747, 1, 'Москва кл Шапошникова 12-34б', 'Василий Петрович', '58787856'),
(62, 2, 1567175747, 2, 'адрес получателя', 'иван', '111112'),
(63, 12, 1568736016, 2, 'Российская Федерация, 127560, МОСКВА Г, УЛ ПЛЕЩЕЕВА, дом 30, кв. 50', 'ДРЯБЕЗГОВ КОНСТАНТИН МИХАЙЛОВИЧ', '89257109555'),
(64, 12, 1568736875, 1, '1111', '1111', '1111111'),
(65, 12, 1569344686, 2, 'Российская Федерация, 127560, МОСКВА Г, УЛ ПЛЕЩЕЕВА, дом 30, кв. 50', 'ДРЯБЕЗГОВ', '89257109555'),
(66, 14, 1569702902, 1, 'ваппвпв', 'апапавп', '54545554'),
(67, 14, 1569702902, 2, 'смавипаисис', 'пвпввпв', '434333543'),
(68, 15, 1569705727, 1, '222222222', '1222222222', '22222222222222'),
(69, 15, 1569705727, 2, '2222222222222222222', '22222222222222222', '2222222222222222'),
(72, 2, 1616678519, 1, 'Москва Сиреневый бульвар 54 к.1 офис .6', 'вапыапа', '+79175977755'),
(73, 2, 1616678519, 2, 'ул. Карла Маркса 47-49', 'апвавп', '+79258600106'),
(80, 2, 1616679956, 1, 'ул. Карла Маркса 47-49', 'eraerhr', '+79258600106'),
(81, 2, 1616679956, 2, 'ул. Карла Маркса 47-49', 'aegger', '+79258600106');

-- --------------------------------------------------------

--
-- Структура таблицы `t_article`
--

CREATE TABLE IF NOT EXISTS `t_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(500) NOT NULL COMMENT 'Заголовок',
  `text` text NOT NULL COMMENT 'Текст',
  `image` varchar(1000) DEFAULT NULL COMMENT 'Изображение',
  `description` varchar(1000) DEFAULT NULL COMMENT 'Описание',
  `keywords` varchar(1000) DEFAULT NULL COMMENT 'Ключевые слова',
  `date` int(11) NOT NULL DEFAULT '0' COMMENT 'Дата публикации',
  `view` int(11) NOT NULL DEFAULT '0' COMMENT 'Тип отображения',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_article`
--

INSERT INTO `t_article` (`article_id`, `title`, `text`, `image`, `description`, `keywords`, `date`, `view`) VALUES
(16, 'Догрузы', '<p>Догрузы</p>', '1552916403.jpg', 'Догрузы', 'Догрузы', 1552867200, 1),
(17, 'Спецтехника', '<p>Спецтехника</p>', '1552916546.jpg', 'Спецтехника', 'Спецтехника', 1552867200, 1),
(18, 'Переезды', '<p>Переезды</p>', '1552916617.jpg', 'Переезды', 'Переезды', 1552867200, 1),
(19, 'Страхование', '<p>Страхование</p>', '1552916667.jpg', 'Страхование', 'Страхование', 1552867200, 1),
(20, 'Грузчики Загол', '<p>Грузчики текст текст</p>', '1552916796.jpg', 'Грузчики описание', 'Грузчики ключи', 1552867200, 1),
(21, 'Сборные грузы', '<p>Сборные грузы</p>', '1552916876.jpg', 'Сборные грузы', 'Сборные грузы', 1552867200, 1),
(22, 'Маркировка', '<p>Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку. Маркировка, статья про маркировку.&nbsp;</p>', '1552921606.jpg', 'Маркировка', 'Маркировка', 1552867200, 4),
(23, 'Схемы размещения паллет в машинах', '<p>Повседневная практика показывает, что рамки и место обучения кадров представляет собой интересный эксперимент проверки систем массового участия.</p>', '1552924555.jpeg', 'Схемы размещения паллет в машинах', 'Схемы размещения паллет в машинах', 1552867200, 2),
(24, 'Дополнительные услуги', '<p>Повседневная практика показывает, что рамки и место обучения кадров представляет собой интересный эксперимент проверки систем массового участия. Не следует, однако забывать, что укрепление и развитие структуры влечет за собой процесс внедрения и модернизации модели развития. Задача организации, в особенности же укрепление и развитие структуры влечет за собой процесс внедрения и модернизации форм развития. Повседневная практика показывает, что рамки и место обучения кадров представляет собой интересный эксперимент проверки систем массового участия. Не следует, однако забывать, что укрепление и развитие структуры влечет за собой процесс внедрения и модернизации модели развития. Задача организации, в особенности же укрепление и развитие структуры влечет за собой процесс внедрения и модернизации форм развития.</p>', '1552924457.jpeg', 'Дополнительные услуги', 'Дополнительные услуги', 1552867200, 2),
(25, 'Перевозка фурой', '<p>Повседневная практика показывает, что рамки и место обучения кадров представляет собой интересный эксперимент проверки систем массового участия. Не следует, однако забывать, что укрепление и развитие структуры влечет за собой процесс внедрения и модернизации модели развития. Задача организации, в особенности же укрепление и развитие структуры влечет за собой процесс внедрения и модернизации форм развития.</p>', '1552924250.jpg', 'Перевозка фурой', 'Перевозка фурой', 1552867200, 2),
(234, 'Упаковка грузов ', '<p>Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; м Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; м Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; м Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; м Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; м Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; м Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; Упаковка грузов Упаковка грузов&nbsp; м&nbsp;</p>', NULL, 'Упаковка грузов', 'Упаковка грузов', 1562112000, 3),
(235, 'Услуги перевозки', '<p>Услуги перевозки Услуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозки Услуги перевозки Услуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозки Услуги перевозки Услуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозкиУслуги перевозки мм</p>', '1563521301.jpg', 'Услуги перевозки ', 'Услуги перевозки ', 1563494400, 3),
(236, 'Подробнее о классах опасности', '<p>Весь список услуг нашей службы доставки доступен как для юридических, так и для физических лиц. Услуги для компаний электронной торговли Для интернет-магазинов мы оказываем перечень услуг, куда входит доставка заказов, товаров, документов и корреспонденции со складов из других городов России, а также из других стран. В нашей компании можно также заказать услуги по доставке товаров клиентам интернет-магазинов, а также передачу заказа нашим курьером клиенту из рук в руки. Мы работаем с крупными оптовыми зарубежными компаниями электронной торговли и выполняем доставку отправлений не только в город, но и в область. Услуги быстрой доставки Если получателю необходимо в короткий срок переслать, или получить документы, или груз, то услуга экспресс-доставки, предоставляемая в нашей организации, обеспечит необходимую скорость грузоотправления и заказчику. Услуга предоставляется и обеспечивает быстрое получение нужного товара в пункт назначения, указанный в договоре, либо на склад нашей компании. В нашей службе может быть оформлена быстрая доставка груза от 30 кг и выше с условием, чтобы курьер сопровождал посылку до самых дверей клиента. Самый простой способ доставки В городе Коломна можно сде</p>', '1569451003.jpg', 'Про классы опасности ', 'Про классы опасности ', 1569456000, 4),
(237, 'Документальное подтверждение стоимости груза', '<p>Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза&nbsp; Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза&nbsp; Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза&nbsp; Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза Документальное подтверждение стоимости груза&nbsp;&nbsp;</p>', '1569452808.jpg', 'Документальное подтверждение стоимости груза', 'Документальное подтверждение стоимости груза', 1569456000, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `t_contact`
--

CREATE TABLE IF NOT EXISTS `t_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Телефон',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email',
  `address` varchar(1000) DEFAULT NULL COMMENT 'Адрес',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_contact`
--

INSERT INTO `t_contact` (`contact_id`, `phone`, `email`, `address`) VALUES
(1, '8(800) 999-99-99', 'mail@mail.ru', '<p>Московская область, г. Москва, ул. Ленина, д3, помещение 1</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `t_contact_shops`
--

CREATE TABLE IF NOT EXISTS `t_contact_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Название',
  `location` varchar(255) NOT NULL COMMENT 'Широта, Долгота',
  `workingdays` varchar(255) NOT NULL COMMENT 'Рабочие дни',
  `weekend` varchar(255) NOT NULL COMMENT 'Выходные',
  `adress` text NOT NULL COMMENT 'Адрес',
  `tel1` varchar(255) NOT NULL COMMENT 'Телефон 1',
  `tel2` varchar(255) NOT NULL COMMENT 'Телефон 2',
  `mail` varchar(255) NOT NULL COMMENT 'Телефон 3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `t_contact_shops`
--

INSERT INTO `t_contact_shops` (`id`, `name`, `location`, `workingdays`, `weekend`, `adress`, `tel1`, `tel2`, `mail`) VALUES
(1, 'МОСКВА', '55.85997856885686,37.337082499999944', 'пон-пят с 9.00 до 18.00', 'суббота, воскресенье', 'Московская область, село Аленкино, Центральная улица, дом 1', '8 (800) 999-88-77', ' 8 (495) 999-99-99', ' info@gruz.ru'),
(2, 'Пункт выдачи 2', '55.62497754456703,37.202096999999945', 'пн-пят 9.00 - 17.00', 'сб, вс', 'Россия, Московская область,город Одинцово ул. Ленина д 2', '+7(999)888-76-87', '+7(999)888-76-87', 'mail@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `t_dedicated_transport_car`
--

CREATE TABLE IF NOT EXISTS `t_dedicated_transport_car` (
  `dt_car_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT 'Заказ',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `load_capacity` int(11) NOT NULL DEFAULT '0' COMMENT 'Грузоподъемность',
  `cargo_params` varchar(1000) DEFAULT NULL COMMENT 'Характер груза',
  `hazard_class` int(11) DEFAULT NULL COMMENT 'Класс опасности',
  `declared_price` float NOT NULL DEFAULT '0' COMMENT 'Объявленная стоимость',
  `city_pick_up` int(11) NOT NULL DEFAULT '0' COMMENT 'Забрать по городу',
  `city_delivery` int(11) NOT NULL DEFAULT '0' COMMENT 'Доставка по городу',
  `pick_up_date` int(11) NOT NULL DEFAULT '0' COMMENT 'Когда забрать',
  `from_address_loading` int(11) DEFAULT '0' COMMENT 'Загрузка (при доставке от адреса)',
  `loading_operations` int(11) DEFAULT '0' COMMENT 'Погрузочные работы (при доставке от адреса)',
  `territory_entry` int(11) DEFAULT '0' COMMENT 'Въезд на территорию (при доставке от адреса)',
  `filling` int(11) NOT NULL DEFAULT '0' COMMENT 'Пломбирование',
  `hard_package` int(11) NOT NULL DEFAULT '0' COMMENT 'Жесткая доупаковка',
  `pallet_transparent` int(11) NOT NULL DEFAULT '0' COMMENT 'Паллетирование (прозрачная пленка)',
  `pallet_black` int(11) NOT NULL DEFAULT '0' COMMENT 'Паллетирование (черная пленка)',
  `tent_remove_to` int(11) NOT NULL DEFAULT '0' COMMENT 'Растентовка при доставке',
  `tent_remove_from` int(11) NOT NULL DEFAULT '0' COMMENT 'Растентовка при заборе',
  `pallet_board_pack` int(11) NOT NULL DEFAULT '0' COMMENT 'Упаковка в сборный паллетный борт',
  `is_draft` int(11) DEFAULT NULL COMMENT 'Черновик',
  PRIMARY KEY (`dt_car_id`,`order_id`),
  KEY `fk_t_dedicated_transport_car_t_order1_idx` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_dedicated_transport_car`
--

INSERT INTO `t_dedicated_transport_car` (`dt_car_id`, `order_id`, `user_id`, `load_capacity`, `cargo_params`, `hazard_class`, `declared_price`, `city_pick_up`, `city_delivery`, `pick_up_date`, `from_address_loading`, `loading_operations`, `territory_entry`, `filling`, `hard_package`, `pallet_transparent`, `pallet_black`, `tent_remove_to`, `tent_remove_from`, `pallet_board_pack`, `is_draft`) VALUES
(4, 39, 10, 3, 'агщгнщг', 7898, 8676800, 0, 0, 1563580800, NULL, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(5, 40, 10, 3, 'оланголн', 66, 8676800, 0, 0, 1563321600, NULL, 1, 0, 0, 1, 0, 1, 0, 0, 0, 1),
(7, 45, 12, 1, 'Оборудование', 0, 10000, 1, 1, 1563408000, 1, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0),
(8, 48, 2, 1, 'jhvjhh', 2, 66576700, 0, 0, 1564185600, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(9, 49, 1, 1, 'Оборудование', 0, 15000, 0, 1, 1563408000, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 1),
(10, 52, 13, 2, 'аыва', 1, 111111, 0, 0, 1564012800, 2, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1),
(11, 61, 2, 1, 'грунт', 1, 23400, 0, 0, 1573257600, 2, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0),
(12, 64, 12, 2, 'Запчасти', 0, 1000000, 1, 1, 1569715200, 1, 0, 0, 1, 1, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `t_dedicated_transport_truck`
--

CREATE TABLE IF NOT EXISTS `t_dedicated_transport_truck` (
  `dt_truck_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT 'Заказ',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `semi_trailer_type` int(11) NOT NULL DEFAULT '0' COMMENT 'Тип полуприцепа',
  `tent_hard_board` int(11) DEFAULT '0' COMMENT 'Жесткий борт (тентовый)',
  `tent_removable_top_beam` int(11) DEFAULT '0' COMMENT 'Съемная верхняя балка (тентовый)',
  `tent_removable_side_beam` int(11) DEFAULT '0' COMMENT 'Съемная боковая балка (тентовый)',
  `cargo_params` varchar(1000) DEFAULT NULL COMMENT 'Характер груза',
  `hazard_class` int(11) DEFAULT NULL COMMENT 'Класс опасности',
  `declared_price` float NOT NULL DEFAULT '0' COMMENT 'Объявленная стоимость',
  `city_pick_up` int(11) NOT NULL DEFAULT '0' COMMENT 'Забрать по городу',
  `city_delivery` int(11) NOT NULL DEFAULT '0' COMMENT 'Доставка по городу',
  `pick_up_date` int(11) NOT NULL DEFAULT '0' COMMENT 'Когда забрать',
  `from_address_loading` int(11) DEFAULT '0' COMMENT 'Загрузка (при доставке от адреса)',
  `loading_operations` int(11) DEFAULT '0' COMMENT 'Погрузочные работы (при доставке от адреса)',
  `territory_entry` int(11) DEFAULT '0' COMMENT 'Въезд на территорию (при доставке от адреса)',
  `filling` int(11) NOT NULL DEFAULT '0' COMMENT 'Пломбирование',
  `hard_package` int(11) NOT NULL DEFAULT '0' COMMENT 'Жесткая доупаковка',
  `pallet_transparent` int(11) NOT NULL DEFAULT '0' COMMENT 'Паллетирование (прозрачная пленка)',
  `pallet_black` int(11) NOT NULL DEFAULT '0' COMMENT 'Паллетирование (черная пленка)',
  `tent_remove_to` int(11) NOT NULL DEFAULT '0' COMMENT 'Растентовка при доставке',
  `tent_remove_from` int(11) NOT NULL DEFAULT '0' COMMENT 'Растентовка при заборе',
  `pallet_board_pack` int(11) NOT NULL DEFAULT '0' COMMENT 'Упаковка в сборный паллетный борт',
  `is_draft` int(11) DEFAULT NULL COMMENT 'Черновик',
  PRIMARY KEY (`dt_truck_id`,`order_id`),
  KEY `fk_t_dedicated_transport_truck_t_order1_idx` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_dedicated_transport_truck`
--

INSERT INTO `t_dedicated_transport_truck` (`dt_truck_id`, `order_id`, `user_id`, `semi_trailer_type`, `tent_hard_board`, `tent_removable_top_beam`, `tent_removable_side_beam`, `cargo_params`, `hazard_class`, `declared_price`, `city_pick_up`, `city_delivery`, `pick_up_date`, `from_address_loading`, `loading_operations`, `territory_entry`, `filling`, `hard_package`, `pallet_transparent`, `pallet_black`, `tent_remove_to`, `tent_remove_from`, `pallet_board_pack`, `is_draft`) VALUES
(3, 50, 2, 1, 1, 0, 0, 'орпропр', 1, 43434, 0, 0, 1564185600, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(4, 59, 2, 1, 0, 0, 0, 'йййй', 1, 43434, 0, 0, 1572652800, NULL, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(5, 63, 2, 1, 1, 0, 0, 'щебенка', 1, 43434, 0, 0, 1573257600, NULL, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0),
(6, 70, 2, 1, 1, 0, 0, 'дд', 3, 5555, 0, 1, 1616803200, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 74, 2, 1, 0, 0, 0, '', NULL, 5555, 0, 0, 1616803200, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `t_documents`
--

CREATE TABLE IF NOT EXISTS `t_documents` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'Покупатель',
  `order_id` int(11) NOT NULL COMMENT 'Заказ',
  `create_date` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `title` varchar(500) NOT NULL COMMENT 'Заголовок файла',
  `name` varchar(500) DEFAULT NULL COMMENT 'Название',
  `uploader` int(11) DEFAULT NULL COMMENT 'Загрузивший админ или пользоватлеь',
  PRIMARY KEY (`document_id`,`user_id`,`order_id`),
  KEY `fk_t_documents_t_order1_idx` (`order_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_documents`
--

INSERT INTO `t_documents` (`document_id`, `user_id`, `order_id`, `create_date`, `title`, `name`, `uploader`) VALUES
(28, 2, 28, 1561953110, 'ТЕСТ!', '28_1561953110.pdf', 2),
(29, 2, 28, 1561953202, 'ТЕСТ2', '28_1561953202.jpg', 2),
(30, 2, 28, 1561953311, 'ТЕСТ3', '28_1561953311.pdf', 2),
(31, 2, 28, 1561953574, 'ТЕСТ4!!!', '28_1561953574.pdf', 2),
(32, 2, 34, 1561953957, '1231232', '34_1561953957.pdf', 2),
(33, 2, 31, 1561954027, 'цкццукауц', '31_1561954027.pdf', 2),
(34, 2, 35, 1561954114, '5454545445', '35_1561954114.pdf', 2),
(35, 2, 36, 1561954202, '6765686856', '36_1561954203.pdf', 2),
(36, 2, 36, 1562000478, '3424', '36_1562000478.pdf', 1),
(37, 10, 38, 1562136817, 'технология', '38_1562136817.docx', 1),
(38, 10, 41, 1562143342, 'Накладная', '41_1562143342.docx', 1),
(39, 2, 34, 1562143502, 'документ по перевозке', '34_1562143502.docx', 2),
(40, 12, 45, 1563451432, 'Реквизиты ', '45_1563451432.doc', 2),
(41, 2, 34, 1563451512, 'рек', '34_1563451512.doc', 2),
(42, 2, 51, 1569265042, 'Накладная', '51_1569265042.png', 1),
(43, 14, 65, 1569703451, 'впап', '65_1569703451.xlsx', 2),
(44, 1, 66, 1569705161, 'счет', '66_1569705161.xls', 1),
(45, 15, 68, 1569705787, 'счет1', '68_1569705787.xls', 1),
(46, 15, 68, 1569705868, 'ответ на счет', '68_1569705868.xls', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `t_document_request`
--

CREATE TABLE IF NOT EXISTS `t_document_request` (
  `document_request_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'Покупатель',
  `order_id` int(11) NOT NULL COMMENT 'Заказ',
  `create_date` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `date_from` int(11) DEFAULT NULL COMMENT 'Дата от',
  `date_to` int(11) DEFAULT NULL COMMENT 'Дата по',
  `contact_person` varchar(500) DEFAULT NULL COMMENT 'Контактное лицо',
  `phone` varchar(100) DEFAULT NULL COMMENT 'Телефон',
  `email` varchar(500) DEFAULT NULL COMMENT 'Email',
  `comment` text COMMENT 'Комментарий',
  `send_post` int(11) DEFAULT NULL COMMENT 'Отправить почтой',
  `post_adress` text COMMENT 'почтовый адрес',
  `send_email` int(11) DEFAULT NULL COMMENT 'Отправить на email',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  PRIMARY KEY (`document_request_id`,`user_id`,`order_id`),
  KEY `fk_t_feedback_request_t_order1_idx` (`order_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_document_request`
--

INSERT INTO `t_document_request` (`document_request_id`, `user_id`, `order_id`, `create_date`, `date_from`, `date_to`, `contact_person`, `phone`, `email`, `comment`, `send_post`, `post_adress`, `send_email`, `status`) VALUES
(5, 2, 36, 1562001337, 14, 27, 'Виталий', '+79503245582', 'vitaly.artyukhin@gmail.com', '23423', 1, NULL, NULL, 2),
(6, 2, 36, 1561001346, 1, 3, 'Виталий', '+79503245582', 'vitaly.artyukhin@gmail.com', '4234234', NULL, NULL, 1, 2),
(7, 2, 36, 1562001356, 1562457600, 1563235200, 'Виталий', '+79503245582', 'vitaly.artyukhin@gmail.com', '324234324', 1, NULL, 1, 1),
(8, 2, 36, 1562001552, 7, 24, 'Виталий', '+79503245582', 'vitaly.artyukhin@gmail.com', '2ewd', NULL, NULL, 1, 2),
(9, 2, 36, 1562001633, 1, 2, 'Виталий', '+79503245582', 'vitaly.artyukhin@gmail.com', '2343', 1, NULL, 1, 2),
(10, 10, 38, 1562136853, 1, 3, 'иван', '899999899999', 'elesin.ivanov@yandex.ru', 'люмолю', 1, NULL, 1, 2),
(11, 2, 58, 1567526181, 1564617600, 1567468800, 'Виталий', '+79503245582', 'vialy@gmail.com', 'олоолорло', 1, 'додододл', 1, 1),
(12, 2, 58, 1567526186, 1564617600, 1567468800, 'Виталий', '+79503245582', 'vialy@gmail.com', 'олоолорло', 1, 'додододл', 1, 1),
(13, 2, 58, 1567526782, 1564617600, 1567468800, 'Виталий', '+79503245582', 'vialy@gmail.com', 'олоолорло', 1, 'додододл', 1, 1),
(14, 2, 58, 1567526785, 1564617600, 1567468800, 'Виталий', '+79503245582', 'vialy@gmail.com', 'олоолорло', 1, 'додододл', 1, 1),
(15, 12, 45, 1568736407, 1543622400, 1568678400, 'Дмитрий', '89257109036', 'vozduhof@yandex.ru', 'документы за период', 1, 'документы за период', 1, 1),
(16, 2, 63, 1569454789, 2, 26, 'Виталик', '+79503245582', 'gulyasmir2015@yandex.ru', 'все', 1, 'почтовый адрес и индекс', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `t_entity_address`
--

CREATE TABLE IF NOT EXISTS `t_entity_address` (
  `entity_address_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `address_id` int(11) NOT NULL COMMENT 'Адрес',
  `legal_form_id` int(11) NOT NULL COMMENT 'Правовая форма',
  `name` varchar(500) DEFAULT NULL COMMENT 'Наименование',
  `country` varchar(500) DEFAULT NULL COMMENT 'Страна',
  `inn` varchar(100) DEFAULT NULL COMMENT 'Инн',
  `kpp` int(11) DEFAULT NULL COMMENT 'КПП',
  PRIMARY KEY (`entity_address_id`,`address_id`,`legal_form_id`),
  KEY `fk_t_adresses_t_legal_forms1_idx` (`legal_form_id`),
  KEY `fk_t_entity_addresses_t_adresses1_idx` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_entity_address`
--

INSERT INTO `t_entity_address` (`entity_address_id`, `address_id`, `legal_form_id`, `name`, `country`, `inn`, `kpp`) VALUES
(5, 10, 1, 'Аникин В М', 'РФ', '1983273500', 0),
(7, 16, 1, 'Аникин В М', 'РФ', '1983273500', 0),
(8, 17, 1, 'Аникин В М', 'РФ', '1983273500', 0),
(9, 18, 1, 'Аникин В М', 'РФ', '1983273500', 0),
(10, 19, 1, 'Аникин В М', 'РФ', '1983273500', 0),
(11, 20, 1, 'Аникин В М', 'РФ', '1983273500', 0),
(12, 26, 1, 'ланголнглн', 'рррррр', '767ц56756', 0),
(13, 27, 1, 'ланглнго', 'нголанглангл', '787686', 0),
(14, 29, 1, 'ланглнго', 'нголанглангл', '54545', 0),
(15, 30, 1, 'ланглнго', 'нголанглангл', '54545', 0),
(16, 31, 1, 'ланглнго', 'нголанглангл', '54545', 0),
(17, 32, 1, 'ланглнго', 'нголанглангл', '54545', 0),
(18, 33, 1, 'ланглнго', 'нголанглангл', '54545', 0),
(19, 36, 1, 'ДРЯБЕЗГОВ КОНСТАНТИН МИХАЙЛОВИЧ', 'Россия', '771508723823', 0),
(20, 37, 1, 'ДРЯБЕЗГОВ КОНСТАНТИН МИХАЙЛОВИЧ', 'Россия', '771508723823', 0),
(21, 40, 7, 'Копыта', 'Россия', '12545587788', 0),
(22, 41, 7, 'Рога', 'Россия', '125485268', 0),
(23, 42, 7, 'Копыта', 'Россия', '12545587788', 0),
(24, 43, 7, 'Рога', 'Россия', '125485268', 0),
(25, 44, 7, 'ывпвпвпвп', 'впвпвапв', '425227277', 0),
(26, 45, 7, 'впваппвп', 'впапвпв', '5555775', 54575467),
(30, 49, 1, 'ланголнглн', 'рррррр', '76756756', 6746744),
(32, 57, 1, 'Рога и копыта', 'Россия', '4674747', NULL),
(33, 59, 1, 'Алматек', 'Россия', '76756756', 6746744),
(34, 61, 1, 'Алматек', 'Россия', '76756756', 6746744),
(35, 63, 1, 'ДРЯБЕЗГОВ КОНСТАНТИН МИХАЙЛОВИЧ', 'Россия', '771508723823', NULL),
(36, 64, 7, '1111111', '11111', '11', 1111),
(37, 65, 1, 'ДРЯБЕЗГОВ КОНСТАНТИН МИХАЙЛОВИЧ', 'Россия', '771508723823', NULL),
(38, 66, 7, 'рога', 'укра', '43545535', NULL),
(39, 67, 7, 'впавпаввппв', 'иаиа', '654646', NULL),
(40, 69, 1, '222222222222222222', '2222222222', '22222222222', NULL),
(43, 72, 1, 'нонконо', 'ыкеоео', '64575', 4674567),
(44, 73, 1, 'аааааа', 'Россия', '564565', 4674567),
(51, 80, 1, 'rerterte', 'Россия', '5555', 55555),
(52, 81, 7, 'erhr', 'Россия', '55555', 55555);

-- --------------------------------------------------------

--
-- Структура таблицы `t_feedback_request`
--

CREATE TABLE IF NOT EXISTS `t_feedback_request` (
  `feedback_request_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'Покупатель',
  `order_id` int(11) NOT NULL COMMENT 'Заказ',
  `create_date` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `title` varchar(1000) DEFAULT NULL COMMENT 'Заголовок',
  `comment` text COMMENT 'Текст',
  `phone` varchar(100) DEFAULT NULL COMMENT 'Телефон',
  `email` varchar(500) DEFAULT NULL COMMENT 'Email',
  `contact_person` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  PRIMARY KEY (`feedback_request_id`,`user_id`,`order_id`),
  KEY `fk_t_document_request_t_order1_idx` (`order_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_feedback_request`
--

INSERT INTO `t_feedback_request` (`feedback_request_id`, `user_id`, `order_id`, `create_date`, `title`, `comment`, `phone`, `email`, `contact_person`, `status`) VALUES
(3, 2, 36, 1562000853, 'Заголовок', 'Текст', '+79503245582', 'vitaly.artyukhin@gmail.com', 'Виталий', 2),
(4, 2, 36, 1561000879, '24234', '234324', '+79503245582', 'vitaly.artyukhin@gmail.com', 'Виталий', 2),
(5, 2, 36, 1562000885, 'рерн', 'уацуа', '+79503245582', 'vitaly.artyukhin@gmail.com', 'Виталий', 2),
(6, 2, 34, 1563453612, 'тттт', 'ттттт', '+79503245582', 'vialy@gmail.com', 'Виталий', 2),
(7, 12, 62, 1569344281, 'Что с сайтом', 'Как долго еще будете делать сайт???', '89257109036', 'vozduhof@yandex.ru', 'Дмитрий', 2),
(8, 12, 62, 1569344551, 'сааааааааайт', 'Нужен сайт', '89257109036', 'vozduhof@yandex.ru', 'Дмитрий', 2),
(9, 12, 62, 1569344598, '212112111111111111', '1111111111111111111111111111111111111', '89257109036', 'vozduhof@yandex.ru', 'Дмитрий', 2),
(10, 12, 60, 1569345339, 'Сайт тест', 'Тест', '89257109036', 'vozduhof@yandex.ru', 'Дмитрий', 2),
(11, 12, 60, 1569345394, 'да тест 2', 'да тест 2', '89257109036', 'vozduhof@yandex.ru', 'Дмитрий', 2),
(12, 12, 45, 1569348107, 'привет', 'проблемы в доставке', '89257109036', 'vozduhof@yandex.ru', 'Дмитрий', 2),
(13, 12, 45, 1569348171, 'тест 222', 'тест222', '89257109036', 'vozduhof@yandex.ru', 'Дмитрий', 2),
(14, 2, 63, 1569454578, '11111', '1111111', '+79503245582', 'vialy@gmail.com', 'Виталий', 2),
(15, 14, 65, 1569703186, 'привет', 'ыаывавыа', '89999999999', 'xxxxx200@mail.ru', 'Серофим', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `t_general_cargo_letter`
--

CREATE TABLE IF NOT EXISTS `t_general_cargo_letter` (
  `gc_letter_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT 'Заказ',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `length` float DEFAULT '0' COMMENT 'Длина',
  `width` float NOT NULL DEFAULT '0' COMMENT 'Ширина',
  `height` float NOT NULL DEFAULT '0' COMMENT 'Высота',
  `weight` float NOT NULL DEFAULT '0' COMMENT 'Вес',
  `volume` float DEFAULT NULL COMMENT 'Объем',
  `cargo_params` varchar(1000) DEFAULT NULL COMMENT 'Характер груза',
  `city_pick_up` int(11) NOT NULL DEFAULT '0' COMMENT 'Забрать по городу',
  `city_delivery` int(11) NOT NULL DEFAULT '0' COMMENT 'Доставка по городу',
  `pick_up_date` int(11) NOT NULL DEFAULT '0' COMMENT 'Когда забрать',
  `territory_entry` int(11) DEFAULT '0' COMMENT 'Въезд на территорию (при доставке от адреса)',
  `is_draft` int(11) DEFAULT NULL COMMENT 'Черновик',
  PRIMARY KEY (`gc_letter_id`,`order_id`),
  KEY `fk_t_general_cargo_letter_t_order1_idx` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_general_cargo_letter`
--

INSERT INTO `t_general_cargo_letter` (`gc_letter_id`, `order_id`, `user_id`, `length`, `width`, `height`, `weight`, `volume`, `cargo_params`, `city_pick_up`, `city_delivery`, `pick_up_date`, `territory_entry`, `is_draft`) VALUES
(4, 51, 2, 1, 1, 1, 0.1, 3, 'гншлвенл', 0, 0, 1567209600, 1, 0),
(5, 60, 12, 1111110, 1111110000000, 111, 1111110, 1111110000000, '1111111', 0, 0, 1568678400, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `t_general_cargo_many_places`
--

CREATE TABLE IF NOT EXISTS `t_general_cargo_many_places` (
  `gc_many_places_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL COMMENT 'Заказ',
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `biggest_length` float NOT NULL DEFAULT '0' COMMENT 'Самое длинное место',
  `biggest_width` float NOT NULL DEFAULT '0' COMMENT 'Самое широкое место',
  `biggest_height` float NOT NULL DEFAULT '0' COMMENT 'Самое высокое место',
  `biggest_weight` float NOT NULL,
  `place_quantity` int(11) NOT NULL DEFAULT '0' COMMENT 'Количество мест',
  `overall_volume` float NOT NULL DEFAULT '0' COMMENT 'Общий объем',
  `overall_weight` float NOT NULL DEFAULT '0' COMMENT 'Общий вес',
  `cargo_params` varchar(1000) DEFAULT NULL COMMENT 'Характер груза',
  `hazard_class` int(11) DEFAULT NULL COMMENT 'Класс опасности',
  `declared_price` float NOT NULL DEFAULT '0' COMMENT 'Объявленная стоимость',
  `city_pick_up` int(11) NOT NULL DEFAULT '0' COMMENT 'Забрать по городу',
  `city_delivery` int(11) NOT NULL DEFAULT '0' COMMENT 'Доставка по городу',
  `pick_up_date` int(11) NOT NULL DEFAULT '0' COMMENT 'Когда забрать',
  `from_address_loading` int(11) DEFAULT '0' COMMENT 'Загрузка (при доставке от адреса)',
  `loading_operations` int(11) DEFAULT '0' COMMENT 'Погрузочные работы (при доставке от адреса)',
  `territory_entry` int(11) DEFAULT '0' COMMENT 'Въезд на территорию (при доставке от адреса)',
  `is_draft` int(11) DEFAULT NULL COMMENT 'Черновик',
  PRIMARY KEY (`gc_many_places_id`,`order_id`),
  KEY `fk_t_general_cargo_many_places_t_order1_idx` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_general_cargo_many_places`
--

INSERT INTO `t_general_cargo_many_places` (`gc_many_places_id`, `order_id`, `user_id`, `biggest_length`, `biggest_width`, `biggest_height`, `biggest_weight`, `place_quantity`, `overall_volume`, `overall_weight`, `cargo_params`, `hazard_class`, `declared_price`, `city_pick_up`, `city_delivery`, `pick_up_date`, `from_address_loading`, `loading_operations`, `territory_entry`, `is_draft`) VALUES
(8, 36, 0, 3, 3, 3, 3, 3, 3, 3, '3', 3, 3, 0, 1, 1567209600, 3, 0, 1, 0),
(9, 41, 10, 434, 32, 23, 234, 2, 432, 2424, '24442fgbdfgbfg', 4, 2545, 0, 1, 1563494400, 2, 0, 1, 0),
(10, 44, 2, 22, 22, 22, 22, 1, 434, 2424, 'паряара', 1, 2545, 1, 0, 1564531200, 1, 0, 1, 0),
(11, 46, 2, 2, 1, 22, 11, 1, 11, 11, 'rgwrgr', 1, 5457460, 0, 0, 1564099200, 2, 0, 0, 0),
(12, 57, 2, 22, 22, 22, 22, 4, 11, 2424, 'песок', 0, 2545, 0, 0, 1567814400, NULL, 0, 0, 0),
(13, 58, 2, 22, 22, 22, 22, 4, 11, 2424, 'песок', 0, 2545, 0, 0, 1567814400, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `t_general_cargo_one_place`
--

CREATE TABLE IF NOT EXISTS `t_general_cargo_one_place` (
  `gc_one_place_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Пользователь',
  `length` float NOT NULL DEFAULT '0' COMMENT 'Длина',
  `width` float NOT NULL DEFAULT '0' COMMENT 'Ширина',
  `height` float NOT NULL DEFAULT '0' COMMENT 'Высота',
  `weight` float NOT NULL DEFAULT '0' COMMENT 'Вес',
  `volume` float DEFAULT NULL COMMENT 'Объем',
  `cargo_params` varchar(1000) DEFAULT NULL COMMENT 'Характер груза',
  `hazard_class` int(11) DEFAULT NULL COMMENT 'Класс опасности',
  `declared_price` float NOT NULL DEFAULT '0' COMMENT 'Объявленная стоимость',
  `city_pick_up` int(11) NOT NULL DEFAULT '0' COMMENT 'Забрать по городу',
  `city_delivery` int(11) NOT NULL DEFAULT '0' COMMENT 'Доставка по городу',
  `pick_up_date` int(11) NOT NULL DEFAULT '0' COMMENT 'Когда забрать',
  `from_address_loading` int(11) DEFAULT '0' COMMENT 'Загрузка (при доставке от адреса)',
  `loading_operations` int(11) DEFAULT '0' COMMENT 'Погрузочные работы (при доставке от адреса)',
  `territory_entry` int(11) DEFAULT '0' COMMENT 'Въезд на территорию (при доставке от адреса)',
  `is_draft` int(11) DEFAULT NULL COMMENT 'Черновик',
  PRIMARY KEY (`gc_one_place_id`,`order_id`),
  KEY `fk_t_general_cargo_one_place_t_order1_idx` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_general_cargo_one_place`
--

INSERT INTO `t_general_cargo_one_place` (`gc_one_place_id`, `order_id`, `user_id`, `length`, `width`, `height`, `weight`, `volume`, `cargo_params`, `hazard_class`, `declared_price`, `city_pick_up`, `city_delivery`, `pick_up_date`, `from_address_loading`, `loading_operations`, `territory_entry`, `is_draft`) VALUES
(11, 33, 2, 1, 1, 1, 1, 3, '1', 1, 1, 0, 0, 1564185600, 2, 1, 1, 0),
(12, 37, 10, 100, 100, 500, 400, 700, '..', 1, 10000, 0, 0, 1565222400, 1, 0, 0, 0),
(13, 38, 10, 100, 100, 500, 400, 700, 'ораолрмываолдмрполд.фкывпмифи', 5, 1e25, 0, 0, 1565395200, 1, 0, 0, 0),
(14, 56, 2, 100, 100, 0.4, 400, NULL, 'елнл', NULL, 5745, 0, 0, 1567209600, 1, 0, 0, 0),
(15, 62, 12, 44444400, 444, 44444, 44444, 44489300, '444444444', 4, 44444, 1, 1, 1568764800, 2, 0, 0, 1),
(16, 65, 14, 1, 1, 1, 1, 3, '', NULL, 675757, 0, 0, 1568851200, NULL, 0, 0, 0),
(17, 66, 1, 12, 1, 1.5, 2222, 14.5, '11', 1, 11111100, 0, 0, 1569801600, 3, 1, 0, 0),
(18, 67, 14, 7, 7, 7, 77, 21, '', NULL, 7575, 0, 0, 1569715200, NULL, 0, 0, 1),
(19, 68, 15, 12, 2, 4, 12000, 18, '2323', 23, 23000000, 1, 1, 1569801600, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `t_individual_address`
--

CREATE TABLE IF NOT EXISTS `t_individual_address` (
  `individual_address_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `address_id` int(11) NOT NULL COMMENT 'Адрес',
  `full_name` varchar(500) DEFAULT NULL COMMENT 'ФИО',
  `country` varchar(500) DEFAULT NULL COMMENT 'Страна',
  `identification` int(11) DEFAULT NULL COMMENT 'Документ',
  `identification_series` int(15) DEFAULT NULL COMMENT 'Серия документа',
  `identification_number` int(15) DEFAULT NULL COMMENT 'Номер документа',
  `identification_uvd` varchar(500) DEFAULT NULL COMMENT 'кем выдан',
  `identification_date` varchar(500) DEFAULT NULL COMMENT 'когда выдан',
  PRIMARY KEY (`individual_address_id`,`address_id`),
  KEY `fk_t_individual_addresses_t_adresses1_idx` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_individual_address`
--

INSERT INTO `t_individual_address` (`individual_address_id`, `address_id`, `full_name`, `country`, `identification`, `identification_series`, `identification_number`, `identification_uvd`, `identification_date`) VALUES
(5, 9, 'Имя Фамилия', 'РФ', 1, 9208, 3243511, 'увд Волгоградской области', '17.02.2010'),
(6, 21, 'иванов', 'россия', 1, 1111, 1111, 'увд Волгоградской области', '17.02.2010'),
(7, 22, 'иванов', 'россия', 1, 1111, 22222, 'увд Волгоградской области', '12.12.2001'),
(8, 23, 'иванов', 'россия', 1, 11111, 1111, 'увд Волгоградской области', '17.02.2010'),
(9, 24, 'иванов', 'россия', 1, 1111, 1111, 'увд Волгоградской области', '17.02.2010'),
(10, 28, 'reryeryer', 'reyere', 1, 64745, 56, 'увд Волгоградской области', '17.02.2010'),
(11, 34, 'Иванов', 'россия', 1, 34434, 23525, 'увд Нижегородской области', '12.12.2001'),
(12, 35, 'иванов11', 'россия', 2, 1111, 1111, 'увд Нижегородской области', '12.12.2001'),
(13, 51, 'Еремеев Иван петрович', 'россия', 1, 456, 546345, 'увд комарово', '18 июня 1970 года'),
(14, 58, 'иванов', 'россия', 1, 46, 15, 'увд Нижегородской области', '12.12.2001'),
(15, 60, 'иванов', 'россия', 1, 11, 15, NULL, NULL),
(16, 62, 'иванов', 'россия', 1, 11, 15, NULL, NULL),
(17, 68, '111111121212', '2222', 1, 2222, 22222, '222222', '222222');

-- --------------------------------------------------------

--
-- Структура таблицы `t_legal_form`
--

CREATE TABLE IF NOT EXISTS `t_legal_form` (
  `legal_form_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `create_date` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `name` varchar(100) DEFAULT NULL COMMENT 'Название',
  PRIMARY KEY (`legal_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_legal_form`
--

INSERT INTO `t_legal_form` (`legal_form_id`, `create_date`, `name`) VALUES
(1, NULL, 'ИП'),
(7, 1562145448, 'ООО');

-- --------------------------------------------------------

--
-- Структура таблицы `t_lk_change`
--

CREATE TABLE IF NOT EXISTS `t_lk_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL COMMENT 'Страница',
  `name_page` varchar(255) NOT NULL COMMENT 'Название страницы',
  `text` text NOT NULL COMMENT 'Текст',
  `pdf` varchar(255) NOT NULL COMMENT 'Образец заявления',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_lk_change`
--

INSERT INTO `t_lk_change` (`id`, `page`, `name_page`, `text`, `pdf`) VALUES
(1, 'lk-change-address', ' Изменить адрес доставки', 'Чтобы изменить адрес доставки Вам необходимо заполнить данное заявление и загрузить его скан сюда (так прислать оригинал нам почтой на адрес: электронка )', '/../../frontend/web/pdf/test.docx'),
(2, 'lk-change-pick-up', 'Приостановить выдачу груза', 'Чтобы приостановить выдачу груза Вам необходимо заполнить данное заявление и загрузить его скан сюда (так прислать оригинал нам почтой на адрес: ..... ..... ..... )', ''),
(3, 'lk-change-city-delivery', 'Заказать доставку до адреса ', 'Чтобы заказать доставку до адреса Вам необходимо заполнить данное заявление и загрузить его скан сюда (так прислать оригинал нам почтой на адрес: ..... ..... ..... )', '');

-- --------------------------------------------------------

--
-- Структура таблицы `t_lk_page`
--

CREATE TABLE IF NOT EXISTS `t_lk_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_info` text NOT NULL,
  `text_cooperation` text NOT NULL,
  `text_help` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_lk_page`
--

INSERT INTO `t_lk_page` (`id`, `text_info`, `text_cooperation`, `text_help`) VALUES
(1, 'Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация Текст для вкладки Информация ', 'Текст для вкладки Условия сотрудничества Текст для вкладки Условия сотрудничества Текст для вкладки Условия сотрудничества Текст для вкладки Условия сотрудничества Текст для вкладки Условия сотрудничества Текст для вкладки Условия сотрудничества Текст для вкладки Условия сотрудничества Текст для вкладки Условия сотрудничества ', 'Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка Текст для вкладки Справка ');

-- --------------------------------------------------------

--
-- Структура таблицы `t_news`
--

CREATE TABLE IF NOT EXISTS `t_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(500) NOT NULL COMMENT 'Заголовок',
  `text` text NOT NULL COMMENT 'Текст',
  `image` varchar(1000) DEFAULT NULL COMMENT 'Изображение',
  `description` varchar(1000) DEFAULT NULL COMMENT 'Описание',
  `keywords` varchar(1000) DEFAULT NULL COMMENT 'Ключевые слова',
  `date` int(11) NOT NULL COMMENT 'Дата публикации',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_news`
--

INSERT INTO `t_news` (`news_id`, `title`, `text`, `image`, `description`, `keywords`, `date`) VALUES
(5, 'Обучение кадров', '<p>Повседневная практика показывает, что рамки и место обучения кадров представляет собой интересный эксперимент проверки систем массового участия. Не следует, однако забывать, что укрепление и развитие структуры влечет за собой процесс внедрения и модернизации модели развития. Задача организации, в особенности же укрепление и развитие структуры влечет за собой процесс внедрения и модернизации форм развития.</p>', '1552920113.jpg', 'Обучение кадров', 'Обучение кадров', 1552694400),
(6, 'Догруз', '<p>Догрузом мы называем грузоперевозку попутным автомобильным транспортом, в кузове которого имеется свободное место, которым могут выгодно и эффективно воспользоваться как грузоотправитель, так и перевозчик. Грузоотправитель получает стоимость грузоперевозки значительно ниже стандартных расценок, а перевозчик получает дополнительный доход к тому, который планировал получить при выполнении основного задания на транспортировку. Для того чтобы предоставить нашим клиентам возможность пользоваться подобным способом грузоперевозки мы предусмотрели ряд основных вопросов, на которые нужно ответить, прежде чем принять товар как &laquo;догруз&raquo;: каков точный адрес погрузки и разгрузки товара? Его вес, объем и тип? В какой срок необходимо осуществить грузоперевозку или каковы точные время и дата загрузки? Так мы определяем удаленность места погрузки от основной магистрали, по которым движутся наши попутные грузовики, и выявляем объективную возможность их &laquo;догруза&raquo;.</p>', '1552921070.jpg', 'Догруз', 'Догруз', 1552867200),
(7, 'Спецтехника', '<p>Транспортные услуги и спецтехника в Казани и Татарстане - адреса, телефоны, схемы проезда, фото, режим работы.</p>', '1552921364.jpg', 'Спецтехника', 'Спецтехника', 1552867200),
(8, 'Сборный груз', '<p>Сборный груз &mdash; это груз, перевозимый сборными партиями. В одной машине мы перевозим сборные грузы разных клиентов, которые оплачивают только ту часть стоимости доставки сборных грузов, которая соответствует объему и месту, занятому под их груз.</p>', '1552921454.jpeg', 'Сборный груз', 'Сборный груз', 1552867200),
(9, 'Маркировка', '<p>Маркировка грузов &ndash; это надписи, условные знаки и отметки непосредственно на продукции, таре, упаковке либо на прошитых, наклеенных или привязанных ярлыках (бирках).</p>\r\n<p>Правильная, четкая маркировка грузов является необходимым условием быстрой доставки их с сохранением качества в процессе транспортирования.</p>', '1552921565.jpg', 'Маркировка', 'Маркировка', 1552867200),
(10, 'аоапоп', '<p>еокеокео</p>', '1562146894.jpg', 'оыкнокно', 'кеокеок', 1563321600),
(11, 'Новость', '<p>НовостьНовость</p>', '1569454361.png', 'Новость', 'Новость', 1563840000);

-- --------------------------------------------------------

--
-- Структура таблицы `t_order`
--

CREATE TABLE IF NOT EXISTS `t_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(11) NOT NULL COMMENT 'Покупатель',
  `sender_id` int(11) NOT NULL COMMENT 'Отправитель',
  `recipient_id` int(11) NOT NULL COMMENT 'Поулчатель',
  `payer_id` int(11) NOT NULL COMMENT 'Плательщик',
  `create_date` int(11) DEFAULT NULL COMMENT 'Дата создания',
  `order_number` varchar(100) DEFAULT NULL COMMENT 'Номер заказа',
  `invoice` varchar(500) DEFAULT NULL COMMENT 'Накладная',
  `number_of_departure` varchar(45) DEFAULT NULL COMMENT 'Номер отправления',
  `from` varchar(500) DEFAULT NULL COMMENT 'Откуда',
  `to` varchar(500) DEFAULT NULL COMMENT 'Куда',
  `route_length` int(11) DEFAULT NULL COMMENT 'расстояние',
  `calculated_price` int(11) DEFAULT NULL COMMENT 'расчетная цена',
  `real_price` int(11) DEFAULT NULL COMMENT 'реальная цена',
  `status` int(11) DEFAULT NULL COMMENT 'Статус',
  PRIMARY KEY (`order_id`,`user_id`,`sender_id`,`recipient_id`,`payer_id`),
  KEY `fk_t_order_t_user1_idx` (`user_id`),
  KEY `fk_t_order_t_adress1_idx` (`sender_id`),
  KEY `fk_t_order_t_adress2_idx` (`recipient_id`),
  KEY `fk_t_order_t_adress3_idx` (`payer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_order`
--

INSERT INTO `t_order` (`order_id`, `user_id`, `sender_id`, `recipient_id`, `payer_id`, `create_date`, `order_number`, `invoice`, `number_of_departure`, `from`, `to`, `route_length`, `calculated_price`, `real_price`, `status`) VALUES
(28, 2, 9, 10, 10, 1561160298, 'СО-28', '', '', 'Казань1', 'Москва1', 666, 666, 0, 1),
(29, 2, 9, 10, 9, 1561167343, 'СМ-29', NULL, NULL, 'Казань2', 'Москва2', 0, 0, 0, 1),
(30, 2, 9, 10, 10, 1561167663, 'СП-30', NULL, NULL, 'Казань3', 'Москва3', 0, 0, 0, 1),
(31, 2, 9, 10, 9, 1561167926, 'ВФ-31', '', '', 'Казань4', 'Москва4', 0, 0, 0, 1),
(32, 2, 9, 10, 10, 1561168492, 'ВМ-32', NULL, NULL, 'Казань5', 'Москва5', 0, 0, 0, 1),
(33, 2, 9, 17, 9, 1563374477, 'СО-33', NULL, NULL, 'Краснодар', 'Саратов', 0, 0, 0, 1),
(34, 2, 9, 10, 9, 1561953890, 'ВМ-34', '324234', '3547576', 'Пенза', 'Рязань', 0, 0, 200000, 3),
(35, 2, 9, 10, 9, 1561954100, 'СП-35', '', '', 'Пенза', 'Рязань', 0, 0, NULL, 1),
(36, 2, 9, 20, 20, 1561954174, 'СМ-36', '', '', 'Рязань', 'Пенза', 0, 0, 44444, 1),
(37, 10, 21, 22, 21, 1562101604, 'СО-37', NULL, NULL, 'москва', 'Калининград', 0, 0, 0, 1),
(38, 10, 23, 24, 24, 1562101778, 'СО-38', NULL, NULL, 'москва', 'Калининград', 0, 0, 0, 1),
(39, 10, 21, 22, 22, 1562137121, 'ВМ-39', NULL, NULL, 'Краснодар', 'Калининград', 0, 0, 0, 1),
(40, 10, 26, 27, 27, 1562142179, 'ВМ-40', NULL, NULL, 'Краснодар', 'Калининград', 0, 0, 0, 0),
(41, 10, 28, 33, 28, 1562142894, 'СМ-41', '', '', 'Краснодар', 'Калининград', 0, 0, 0, 1),
(43, 2, 9, 18, 9, 1563367158, 'ВМ-43', NULL, NULL, 'Москва', 'Самара', 0, 0, 0, 1),
(44, 2, 9, 17, 9, 1563374368, 'СМ-44', NULL, NULL, 'Краснодар', 'Уфа', 0, 0, 0, 1),
(45, 12, 36, 63, 36, 1563378938, 'ВМ-45', '', '', 'Мытищи', 'Москва', 0, 0, 0, 3),
(46, 2, 9, 16, 16, 1563379239, 'СМ-46', NULL, NULL, 'Краснодар', 'Калининград', 0, 0, 0, 1),
(48, 2, 9, 10, 10, 1567507609, 'ВМ-48', '', '', 'Краснодар', 'Калининград', 2441, 70799, 0, 2),
(49, 1, 42, 43, 43, 1563450758, 'ВМ-49', NULL, NULL, 'Мытищи', 'Нижний Новгород', 0, 0, 0, 0),
(50, 2, 9, 16, 16, 1563448630, 'ВФ-50', NULL, NULL, 'москва', 'москва', 0, 0, 0, 1),
(51, 2, 57, 16, 57, 1568749900, 'СП-51', NULL, NULL, 'Москва ул.Ленина д.2', 'Москва Сиреневый бульвар д.11', 41, 1035, 0, 1),
(52, 13, 44, 45, 45, 1563948778, 'ВМ-52', NULL, NULL, 'москва', 'самара', 0, 0, 0, 0),
(56, 2, 9, 10, 10, 1567174216, 'СО-56', NULL, NULL, 'москва', 'Калининград', 0, 0, 0, 1),
(57, 2, 59, 60, 60, 1567175687, 'СМ-57', NULL, NULL, 'Краснодар', 'Калининград', 0, 0, 0, 1),
(58, 2, 9, 10, 10, 1567180648, 'СМ-58', NULL, NULL, 'Краснодар', 'Калининград', 2385, 52480, 0, 1),
(59, 2, 57, 16, 57, 1568712916, 'ВФ-59', NULL, NULL, 'Москва', 'Сочи', 1623, 64930, NULL, 1),
(60, 12, 64, 65, 65, 1568752943, 'СП-60', NULL, NULL, '11111', '111111111111', NULL, NULL, NULL, 1),
(61, 2, 57, 16, 57, 1568746502, 'ВМ-61', NULL, NULL, 'Краснодар', 'Калининград', 2384, 69146, NULL, 1),
(62, 12, 36, 63, 63, 1569160642, 'СО-62', NULL, NULL, '4444444444444444444', '44444444444444444444', NULL, NULL, NULL, 0),
(63, 2, 49, 19, 49, 1569265365, 'ВФ-63', NULL, NULL, 'москва', 'Сочи', 1623, 64930, NULL, 1),
(64, 12, 36, 63, 63, 1569663509, 'ВМ-64', NULL, NULL, 'Мытищи', 'Самара', 1087, 31533, NULL, 1),
(65, 14, 66, 67, 67, 1569702902, 'СО-65', NULL, NULL, 'москва', 'питер', 715, 8590, NULL, 1),
(66, 1, 42, 43, 43, 1569780357, 'СО-66', NULL, NULL, 'москва', 'киев', 854, 10258, NULL, 1),
(67, 14, 66, 67, 67, 1569705693, 'СО-67', NULL, NULL, 'москва', 'ростов на дону', 1075, 12910, NULL, 0),
(68, 15, 68, 69, 68, 1569705727, 'СО-68', NULL, NULL, 'Москва', 'Тыва', 4709, 56518, NULL, 1),
(70, 2, 72, 73, 73, 1616678519, 'ВФ-70', NULL, NULL, 'москва', 'рязань', 211, 8450, NULL, 1),
(74, 2, 80, 81, 80, 1616679956, 'ВФ-74', NULL, NULL, 'Краснодар', 'Калининград', 2582, 103290, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `t_rate`
--

CREATE TABLE IF NOT EXISTS `t_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL COMMENT 'Тип доставки',
  `delivery_tariff` int(11) NOT NULL COMMENT 'Стоимость за км',
  `minimum_cost` int(11) NOT NULL COMMENT 'Минимальная общая стоимость',
  `constant` int(11) NOT NULL COMMENT 'Добавляемая константа',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_rate`
--

INSERT INTO `t_rate` (`id`, `type`, `delivery_tariff`, `minimum_cost`, `constant`) VALUES
(1, 'Сборный груз 1 место', 12, 100, 10),
(2, 'Сборный груз несколько мест', 22, 22, 10),
(3, 'Письмо', 25, 22, 10),
(4, 'Фура', 40, 100, 10),
(5, 'Выделенная машина', 29, 22, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `t_text_for_page`
--

CREATE TABLE IF NOT EXISTS `t_text_for_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL COMMENT 'страница',
  `name_page` varchar(255) NOT NULL COMMENT 'Название страницы',
  `title_text` text NOT NULL COMMENT 'заголовок для текста',
  `text` text NOT NULL,
  `title_seo` varchar(255) NOT NULL COMMENT 'заголовок для title страницы',
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_text_for_page`
--

INSERT INTO `t_text_for_page` (`id`, `page`, `name_page`, `title_text`, `text`, `title_seo`, `description`, `keywords`) VALUES
(1, 'index', 'Главная страница', 'Компания «Грузовоз»', 'текст для главной\r\nКомпания по доставке грузов «Грузовоз» проводит в городе Коломна курьерские и транспортные услуги, в которые входит отправка груза по месту назначения, доставка посылок, а также ряд сервисных услуг, которые могут сделать процедуру доставки, транспортировки грузов максимально привлекательной для наших клиентов. Весь список услуг нашей службы доставки доступен как для юридических, так и для физических лиц.\r\n\r\nУслуги для компаний электронной торговли\r\nДля интернет-магазинов мы оказываем перечень услуг, куда входит доставка заказов, товаров, документов и корреспонденции со складов из других городов России, а также из других стран. В нашей компании можно также заказать услуги по доставке товаров клиентам интернет-магазинов, а также передачу заказа нашим курьером клиенту из рук в руки. Мы работаем с крупными оптовыми зарубежными компаниями электронной торговли и выполняем доставку отправлений не только в город, но и в область.\r\n\r\nУслуги быстрой доставки\r\nЕсли получателю необходимо в короткий срок переслать, или получить документы, или груз, то услуга экспресс-доставки, предоставляемая в нашей организации, обеспечит необходимую скорость грузоотправления и заказчику. Услуга предоставляется и обеспечивает быстрое получение нужного товара в пункт назначения, указанный в договоре, либо на склад нашей компании. В нашей службе может быть оформлена быстрая доставка груза от 30 кг и выше с условием, чтобы курьер сопровождал посылку до самых дверей клиента. \r\n\r\nСамый простой способ доставки\r\nВ городе Коломна можно сделать отправление, или доставку грузов очень дёшево, если воспользоваться в нашей компании услугой по экономной доставке грузов. Рассчитают несколько самых оптимальных способов получения и доставки документов, посылок и ценных вещей, отправляемых из разных регионов России, самый оптимальный вариант отправить груз в любой город России.\r\n\r\nЕсли товар необходимо отправить на большое расстояние, то специальная услуга авиаперевозок, заказанная в компании «Грузовоз», поможет хорошо сократить время ожидания на получение нужного товара.\r\n\r\nНаш сервис\r\nОтправление, или доставка посылок, заказанная у наших специалистов, станет очень удобным способом получить нужный груз у себя дома прямо от курьера в кратчайший срок. Оплачивать доставку товара может не только отправитель, но и получатель.\r\n\r\n', 'Транспортная компания Грузовоз', 'сео description для главной', 'сео keywords для главной'),
(2, 'login', 'Страница входа в Личный кабинет', 'Личный кабинет позволяет:', '\r\nотследить заказы;\r\nсамостоятельно оформить и распечатать заполненные для отправки накладные;\r\nпроизвести расчет стоимости доставки с учетом предоставленных скидок по одному или нескольким направлениям;\r\nполучить информацию о состоянии счета;\r\nполучить информацию о контактах закрепленных сотрудников.\r\nполучить акты оказанных услуг за весь период\r\nсформировать акт сверки\r\nполучить информацию по реестрам перечисления наложенных платежей', 'Вход в личный кабинет', 'description description', 'keywords keywords'),
(3, 'registration', 'Страница регистрации', 'Личный кабинет позволяет:', '\r\nотследить заказы;\r\nсамостоятельно оформить и распечатать заполненные для отправки накладные;\r\nпроизвести расчет стоимости доставки с учетом предоставленных скидок по одному или нескольким направлениям;\r\nполучить информацию о состоянии счета;\r\nполучить информацию о контактах закрепленных сотрудников.\r\nполучить акты оказанных услуг за весь период\r\nсформировать акт сверки\r\nполучить информацию по реестрам перечисления наложенных платежей', 'Регистрация ', 'description description', 'keywords keywords'),
(4, 'contact', 'Страница Контакты (Представительства)', 'Заголовок для ceo текста на страницу Контакты', 'Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты Текст для страницы контакты ', 'Контакты', 'description для страницы контакты', 'keywords для страницы контакты'),
(5, 'about', 'Страница О нас', 'Заголовок для ceo текста на страницу  О нас', 'Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас Текст для страницы О нас ', 'О нас', 'description для страницы О нас', 'keywords для страницы О нас'),
(6, 'articles', 'Страница Статьи (где все статьи)', 'Заголовок для ceo текста на страницу  Статьи', 'Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи Текст для страницы Статьи ', 'Статьи', 'description для страницы Статьи', 'keywords для страницы Статьи'),
(7, 'news', 'Страница Новости (где все новости)', 'Заголовок для ceo текста на страницу  Новости', 'Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости Текст для страницы Новости ', 'Новости ', 'description для страницы Новости ', 'keywords для страницы Новости ');

-- --------------------------------------------------------

--
-- Структура таблицы `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Имя',
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Фамилия',
  `patronymic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Отчество',
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Номер телефона',
  `inn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ИНН',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `role` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `name`, `surname`, `patronymic`, `phone`, `inn`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'hWglcfrU8mTWzsV6o26tFnZZN6OetviR', '$2y$13$F9Q7FXGETL4XGJeJlaGDAu1sDsocZA.ykj51h1Dae/27tIRnaBczS', NULL, 'gulyasmir@yandex.ru', 'Админ', '-', '-', '-', '-', 10, 10, 1552989809, 1562224796),
(2, 'customer', '_iNqOMgSWw1rppCHz1C_KZxobSYUzOtx', '$2y$13$0z1C/8.nm2Y416.luau6YOdTEFHS7EXwObzk1XMcLinbQVRNfcDim', NULL, 'gulyasmir2015@yandex.ru', 'Виталик', 'А', 'В', '+79503245582', '124325235', 10, 1, 1552989766, 1553086911),
(3, 'customer2', '8smNk9bWJCTA3MtAbBXqBcuqM_3TGLsh', '$2y$13$KgZJWAwrvCeraLyaARXWAON.cvu4FS8pjxdLOgb5fKjdm7ND/.lb.', NULL, 'vitaly77@gmail.com', 'Виталий', 'А', 'В', '+79503245582', '124215125', 10, 1, 1552989784, 1553007725),
(8, 'customer3', 'rwWd7P_7EAXW9pOmuToA3NQPtifbzrQ_', '$2y$13$QrQndmVyRXv61XTqGkDIzO3pG/8pT.FwXJ9HdSeXqN3BNXvB41.ae', NULL, 'vf@fewf.com', 'Виталий', 'А', NULL, '94336363', NULL, 10, 1, 1553188898, 1553188898),
(9, 'customer4', 'Uo9kdP4aZ9YGw7ftl_tDgFhHEzqofPLJ', '$2y$13$J4v28bIWTerhj7VZVoaUk.nWhscjfA7gECmNpGLYxI141iUL8jUNi', NULL, 'wew@fwf.com', 'Виталий', 'А', '', '324325', '', 10, 1, 1553194238, 1561944095),
(10, '111', 'pqvZNlOj8x_NOHxLKQV6no4-A0NLCp2_', '$2y$13$2AuXMErNb7211U87IZxIZuN9jFw5J1SxKxLIGoZ9p7gx5AJg/M7Ge', NULL, 'elesin.ivanov@yandex.ru', 'иван', 'иванов', NULL, '899999899999', NULL, 10, 1, 1562101412, 1562101412),
(11, 'vasya', 'B1T0mupu0oXoL3lkTuf9UdVA7b6vs3sA', '$2y$13$mwtKxA0YQ/WHhLGwuA.glu2bZ43K2hwkJfs8E/q2OK3S8poqmWupe', NULL, 'ivanov@yandex.ru', 'вася', 'иванов', NULL, '899999899999', NULL, 10, 1, 1562143026, 1562143026),
(12, 'Dima', 'bwQv9FoIDzpr3ngbN6Pm8l1Sw9zDg06o', '$2y$13$2NJDUbmQJaBUKuSY4RDz5u3QDzmSaYs/tToiYuT5lv6.rL9cYE8rm', NULL, 'vozduhof@yandex.ru', 'Дмитрий', 'Толмачев', NULL, '89257109036', NULL, 10, 1, 1563378634, 1563378634),
(13, '484161', '7Cuv_XX6MMt5wyx7AEHLrSRYhAig7QuJ', '$2y$13$pgl42cKwVj8DQ9j1LHh10eXJpBMMZXQ.Kq/n0LkPnAUzWhlSbSu06', '9pTN7FxVu4caCoxdj5tg90YeKJ0GV8Jf_1569780655', '484161@mail.ru', 'Николай', 'Хозяенко', NULL, '89605635533', NULL, 10, 1, 1563380192, 1569780655),
(14, 'xxxxx200', 'cnnQSoHMYsZovWyVsyJyENWsWT-coQUU', '$2y$13$53LhrXSO0sjp0oYcOqyYCumFWab9rbrABWH7y4tagfCljlY8hHRCG', NULL, 'xxxxx200@mail.ru', 'Серофим', 'Гадин', NULL, '89999999999', NULL, 10, 1, 1569701136, 1569701136),
(15, 'sap', 'nxVrNQN7RB1az91rWPL__J4NKsI1s5VU', '$2y$13$L4I/MC3Ju9r5bJqkxvYeaOkAHejh28PspQfV/SFK2fVYZbOrm3Z7u', 'whaKmXjrpXfWGvmTVPWXj-ZVnDtj2QLz_1569704826', 'tkgruzovoz@yandex.ru', 'Дмитрий', 'Толмачев', NULL, '89257109036', NULL, 10, 1, 1569704778, 1569704826);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `t_address`
--
ALTER TABLE `t_address`
  ADD CONSTRAINT `fk_t_adress_t_user1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_dedicated_transport_car`
--
ALTER TABLE `t_dedicated_transport_car`
  ADD CONSTRAINT `fk_t_dedicated_transport_car_t_order1` FOREIGN KEY (`order_id`) REFERENCES `t_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_dedicated_transport_truck`
--
ALTER TABLE `t_dedicated_transport_truck`
  ADD CONSTRAINT `fk_t_dedicated_transport_truck_t_order1` FOREIGN KEY (`order_id`) REFERENCES `t_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_documents`
--
ALTER TABLE `t_documents`
  ADD CONSTRAINT `fk_t_documents_t_order1` FOREIGN KEY (`order_id`,`user_id`) REFERENCES `t_order` (`order_id`, `user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_document_request`
--
ALTER TABLE `t_document_request`
  ADD CONSTRAINT `fk_t_feedback_request_t_order1` FOREIGN KEY (`order_id`,`user_id`) REFERENCES `t_order` (`order_id`, `user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_entity_address`
--
ALTER TABLE `t_entity_address`
  ADD CONSTRAINT `fk_t_adresses_t_legal_forms10` FOREIGN KEY (`legal_form_id`) REFERENCES `t_legal_form` (`legal_form_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_entity_addresses_t_adresses1` FOREIGN KEY (`address_id`) REFERENCES `t_address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_feedback_request`
--
ALTER TABLE `t_feedback_request`
  ADD CONSTRAINT `fk_t_document_request_t_order1` FOREIGN KEY (`order_id`,`user_id`) REFERENCES `t_order` (`order_id`, `user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_general_cargo_letter`
--
ALTER TABLE `t_general_cargo_letter`
  ADD CONSTRAINT `fk_t_general_cargo_letter_t_order1` FOREIGN KEY (`order_id`) REFERENCES `t_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_general_cargo_many_places`
--
ALTER TABLE `t_general_cargo_many_places`
  ADD CONSTRAINT `fk_t_general_cargo_many_places_t_order1` FOREIGN KEY (`order_id`) REFERENCES `t_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_general_cargo_one_place`
--
ALTER TABLE `t_general_cargo_one_place`
  ADD CONSTRAINT `fk_t_general_cargo_one_place_t_order1` FOREIGN KEY (`order_id`) REFERENCES `t_order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_individual_address`
--
ALTER TABLE `t_individual_address`
  ADD CONSTRAINT `fk_t_individual_addresses_t_adresses1` FOREIGN KEY (`address_id`) REFERENCES `t_address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `t_order`
--
ALTER TABLE `t_order`
  ADD CONSTRAINT `fk_t_order_t_adress1` FOREIGN KEY (`sender_id`) REFERENCES `t_address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_order_t_adress2` FOREIGN KEY (`recipient_id`) REFERENCES `t_address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_order_t_adress3` FOREIGN KEY (`payer_id`) REFERENCES `t_address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_order_t_user1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
