<?php

namespace frontend\controllers;
use common\models\Contact;

use yii\web\Controller;
use Yii;

class BaseController extends Controller
{
    public $contacts;
    public $geo_city;
    
    public function init()
    {
        // Автоопределение города
        if (!isset($_COOKIE['geo_city'])) {
            $geo_data = \Yii::$app->geo->getData();
            if (isset($geo_data['city'])) {
                setcookie("geo_city", $geo_data['city'], time() + (3600 * 24 * 3));
                $this->geo_city = $geo_data['city'];
            } else {
                $this->geo_city = 'Неизвестно';
            }
        } else {
            $this->geo_city = $_COOKIE['geo_city'];
        }
        
        // Контакты сайта
        $this->contacts = Contact::findOne([
            'contact_id' => 1,
        ]);
    }
    
    // Полученеи данные из связанной таблицы по заказу
    public function get_order_data($order) {
        
        $order_data = [];
        
        // Сборный груз одно место
        if (mb_stripos($order->order_number, 'СО-') !== false) {
            
            if (isset($order->generalCargoOnePlace['order_id'])) {
                $order_data = $order->generalCargoOnePlace;
            }
            
        // Сборный груз несколько мест
        } elseif (mb_stripos($order->order_number, 'СМ-') !== false) {
            
            if (isset($order->generalCargoManyPlace['order_id'])) {
                $order_data = $order->generalCargoManyPlace;
            }
            
        // Сборный груз письмо
        } elseif (mb_stripos($order->order_number, 'СП-') !== false) {
            
            if (isset($order->generalCargoLetter['order_id'])) {
                $order_data = $order->generalCargoLetter;
            }
            
        // Выделенный транспорт фура
        } elseif (mb_stripos($order->order_number, 'ВФ-') !== false) {
            
            if (isset($order->dedicatedTransportTruck['order_id'])) {
                $order_data = $order->dedicatedTransportTruck;
            }
            
        // Выделенный транспорт машина
        } elseif (mb_stripos($order->order_number, 'ВМ-') !== false) {
            
            if (isset($order->dedicatedTransportCar['order_id'])) {
                $order_data = $order->dedicatedTransportCar;
            }
        }
        
        return $order_data;
    }
    
    // Полученеи данные из связанной таблицы по адресу заказа
    public function get_address_data($address) {
        
        $address_data = [];
        
        // Физ
        if ($address->type == 1) {
            
            if (isset($address->individualAddress['address_id'])) {
                $address_data = $address->individualAddress;
            }
            
        // Юр
        } elseif ($address->type == 2) {
            
            if (isset($address->entityAddress['address_id'])) {
                $address_data = $address->entityAddress;
            }
        }
        
        return $address_data;
    }
}
?>