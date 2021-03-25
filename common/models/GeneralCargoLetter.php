<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%general_cargo_letter}}".
 */
class GeneralCargoLetter extends \yii\db\ActiveRecord
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
        return '{{%general_cargo_letter}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pick_up_date'], 'validateDate'],
            [['length', 'width', 'height', 'weight', /*'cargo_params',*/ 'from', 'to', 'pick_up_date'], 'required'],
            [['gc_letter_id', 'order_id', 'city_pick_up', 'city_delivery', 'territory_entry', 'is_draft','real_price'], 'integer'],
            [['length', 'width', 'height', 'weight', 'volume'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]*\s*$/'],
            [['cargo_params'], 'string', 'max' => 1000],
            [['from', 'to'], 'string', 'max' => 500],
            [['gc_letter_id', 'order_id'], 'unique', 'targetAttribute' => ['gc_letter_id', 'order_id']],
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
            'gc_letter_id' => 'ID',
            'order_id' => 'Заказ',
            'user_id' => 'Пользователь',
            'length' => 'Длина, м',
            'width' => 'Ширина, м',
            'height' => 'Высота, м',
            'weight' => 'Вес, кг',
            'volume' => 'Объем, м',
            'cargo_params' => 'Характер груза',
            'from' => 'Откуда',
            'to' => 'Куда',
            'real_price'=> 'Реальная цена доставки, руб.',
            'city_pick_up' => 'Забрать по городу',
            'city_delivery' => 'Доставка по городу',
            'pick_up_date' => 'Когда забрать',
            'territory_entry' => 'Въезд на территорию отправителя',
            'is_draft' => 'Черновик',

            'number_of_departure' => 'Номер отправления',
            'invoice' => 'Накладная',
            'status' => 'Статус',
            'orderNumber' => 'Номер заказа',
            'userPhone' => 'Телефон',
            'userName' => 'Имя',
            'userSurname' => 'Фамилия',
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
     * @return \common\models\queries\GeneralCargoLetterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\GeneralCargoLetterQuery(get_called_class());
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
                ['html' => \Yii::$app->params['email'][$role]['cargo_letter']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['cargo_letter']['subject'])
        ->send();
    }

    public function validateDate() {

        $currentDate = \Yii::$app->formatter->asTimestamp(date('d.m.Y'));
        $pick_up_date = \Yii::$app->formatter->asTimestamp($this->pick_up_date);

    //    if ($currentDate > $pick_up_date) {
    //        $this->addError('pick_up_date', 'Дата "Когда забрать" не может быть раньше текущей даты');
    //    }
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
