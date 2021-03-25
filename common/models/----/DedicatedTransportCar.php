<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%dedicated_transport_car}}".
 *
 * @property int $dt_car_id ID
 * @property int $user_id Покупатель
 * @property int $load_capacity Грузоподъемность
 * @property string $cargo_params Характер груза
 * @property int $hazard_class Класс опасности
 * @property double $declared_price Объявленная стоимость
 * @property string $from Откуда
 * @property string $to Куда
 * @property int $city_pick_up Забрать по городу
 * @property int $city_delivery Доставка по городу
 * @property int $pick_up_date Когда забрать
 * @property int $from_address_loading Загрузка (при доставке от адреса)
 * @property int $loading_operations Погрузочные работы (при доставке от адреса)
 * @property int $territory_entry Въезд на территорию (при доставке от адреса)
 * @property int $filling Пломбирование
 * @property int $hard_package Жесткая доупаковка
 * @property int $pallet_transparent Паллетирование (прозрачная пленка)
 * @property int $pallet_black Паллетирование (черная пленка)
 * @property int $tent_remove_to Растентовка при доставке
 * @property int $tent_remove_from Растентовка при заборе
 * @property int $pallet_board_pack Упаковка в сборный паллетный борт
 * @property int $is_draft Черновик
 */
class DedicatedTransportCar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dedicated_transport_car}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['pick_up_date'], 'date', 'format' => 'dd.MM.yyyy'],
            [['pick_up_date'], 'validateDate'],
            [['load_capacity', 'cargo_params', 'hazard_class', 'declared_price', 'from', 'to', 'pick_up_date'], 'required'],
            ['load_capacity', 'in', 'range' => [1, 2, 3]],
            [['dt_car_id', 'user_id', 'load_capacity', 'hazard_class', 'city_pick_up', 'city_delivery', 'from_address_loading', 'loading_operations', 'territory_entry', 'filling', 'hard_package', 'pallet_transparent', 'pallet_black', 'tent_remove_to', 'tent_remove_from', 'pallet_board_pack', 'is_draft'], 'integer'],
            [['declared_price'], 'number'],
            [['cargo_params'], 'string', 'max' => 1000],
            [['from', 'to'], 'string', 'max' => 500],
            [['dt_car_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dt_car_id' => 'ID',
            'user_id' => 'Покупатель',
            'load_capacity' => 'Грузоподъемность',
            'cargo_params' => 'Характер груза',
            'hazard_class' => 'Класс опасности',
            'declared_price' => 'Объявленная стоимость',
            'from' => 'Откуда',
            'to' => 'Куда',
            'city_pick_up' => 'Забрать по городу',
            'city_delivery' => 'Доставка по городу',
            'pick_up_date' => 'Когда забрать',
            'from_address_loading' => 'Загрузка',
            'loading_operations' => 'Погрузочные работы',
            'territory_entry' => 'Въезд на территорию отправителя',
            'filling' => 'Пломбирование',
            'hard_package' => 'Жесткая доупаковка',
            'pallet_transparent' => 'Паллетирование (прозр. пленка)',
            'pallet_black' => 'Паллетирование (черн. пленка)',
            'tent_remove_to' => 'Растентовка при доставке',
            'tent_remove_from' => 'Растентовка при заборе',
            'pallet_board_pack' => 'Упаковка в сборный паллетный борт',
            'is_draft' => 'Черновик',
            
            'userPhone' => 'Телефон',
            'userName' => 'Имя',
            'userSurname' => 'Фамилия',
        ];
    }
    
    public function send_email($email, $role) {
        
        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->identity;
        } else {
            $user = new User();
        }
        
        $contacts = Contact::findOne([
            'contact_id' => 1,
        ]);
        
        $mailer = \Yii::$app->mailer;
        $mailer->useFileTransport = false;
        return $mailer->compose(
                ['html' => \Yii::$app->params['email'][$role]['dedicated_car']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['dedicated_car']['subject'])
        ->send();
    }
    
    public function validateDate() {
        
        $currentDate = \Yii::$app->getFormatter()->asDate(time());
        $pick_up_date = \Yii::$app->getFormatter()->asDate(\Yii::$app->formatter->asTimestamp($this->pick_up_date));
        
        if ($currentDate > $pick_up_date) {
            $this->addError('pick_up_date', 'Дата "Когда забрать" не может быть раньше текущей даты');
        }
    }
    
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getUserPhone() {
        return $this->getUser();
    }
    
    public function getUserName() {
        return $this->getUser();
    }
    
    public function getUserSurname() {
        return $this->getUser();
    }
    
    public function getFormattedDate() {
        return date('d.m.Y', $this->pick_up_date);
    }
}
