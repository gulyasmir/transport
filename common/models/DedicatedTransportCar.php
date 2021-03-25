<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%dedicated_transport_car}}".
 */
class DedicatedTransportCar extends \yii\db\ActiveRecord
{
    public $from;
    public $to;
    public $userName;
    public $userPhone;
    public $userSurname;
    public $status;
    public $orderNumber;
    public $number_of_departure;
    public $invoice;
      public $real_price;
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
            [['pick_up_date'], 'validateDate'],
            [['load_capacity', /*'cargo_params', 'hazard_class',*/ 'declared_price', 'from', 'to', 'pick_up_date'], 'required'],
            [['dt_car_id', 'order_id', 'load_capacity', 'hazard_class', 'city_pick_up', 'city_delivery', 'from_address_loading', 'loading_operations', 'territory_entry', 'filling', 'hard_package', 'pallet_transparent', 'pallet_black', 'tent_remove_to', 'tent_remove_from', 'pallet_board_pack', 'is_draft','real_price'], 'integer'],
            [['declared_price'], 'number'],
            ['load_capacity', 'in', 'range' => [1, 2, 3]],
            [['cargo_params'], 'string', 'max' => 1000],
            [['from', 'to'], 'string', 'max' => 500],
            [['dt_car_id', 'order_id'], 'unique', 'targetAttribute' => ['dt_car_id', 'order_id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'order_id']],
            [['userName', 'userPhone', 'userSurname', 'orderNumber', 'status', 'number_of_departure', 'invoice'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dt_car_id' => 'ID',
            'order_id' => 'Заказ',
            'user_id' => 'Пользователь',
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
                'real_price'=> 'Реальная цена доставки, руб.',

            'number_of_departure' => 'Номер отправления',
            'invoice' => 'Накладная',
            'status' => 'Статус',
            'orderNumber' => 'Номер заказа',
            'userPhone' => 'Телефон',
            'userName' => 'Имя',
            'userSurname' => 'Фамилия',
            'payer' => 'Плательщик',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\DedicatedTransportCarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\DedicatedTransportCarQuery(get_called_class());
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

        $currentDate = \Yii::$app->formatter->asTimestamp(date('d.m.Y'));
        $pick_up_date = \Yii::$app->formatter->asTimestamp($this->pick_up_date);

    //    if ($currentDate > $pick_up_date) {
    //        $this->addError('pick_up_date', 'Дата "Когда забрать" не может быть раньше текущей даты');
  //      }
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    //public function getUserPhone() {
    //    return $this->getUser();
    //}

    //public function getUserName() {
    //    return $this->getUser();
    //}

    //public function getUserSurname() {
    //    return $this->getUser();
    //}

    public function getFormattedDate() {
        return date('d.m.Y', $this->pick_up_date);
    }
}
