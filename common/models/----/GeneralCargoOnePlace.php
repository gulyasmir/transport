<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%general_cargo_one_place}}".
 *
 * @property int $gc_one_place_id ID
 * @property int $user_id Покупатель
 * @property double $create_date Длина
 * @property double $length Длина
 * @property double $width Ширина
 * @property double $height Высота
 * @property double $weight Вес
 * @property double $volume Объем
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
 * @property int $is_draft Черновик
 */
class GeneralCargoOnePlace extends \yii\db\ActiveRecord
{
    public $payer;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%general_cargo_one_place}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['pick_up_date'], 'date', 'format' => 'dd.MM.yyyy'],
            [['pick_up_date'], 'validateDate'],
            [['length', 'width', 'height', 'weight', 'volume', 'cargo_params', 'hazard_class', 'declared_price', 'from', 'to', 'pick_up_date'], 'required'],
            [['gc_one_place_id', 'user_id', 'create_date', 'hazard_class', 'city_pick_up', 'city_delivery', 'from_address_loading', 'loading_operations', 'territory_entry', 'is_draft'], 'integer'],
            [['length', 'width', 'height', 'weight', 'volume', 'declared_price'], 'number'],
            [['cargo_params'], 'string', 'max' => 1000],
            [['from', 'to'], 'string', 'max' => 500],
            [['gc_one_place_id'], 'unique'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gc_one_place_id' => 'ID',
            'user_id' => 'Покупатель',
            'create_date' => 'Дата создания',
            'length' => 'Длина, см',
            'width' => 'Ширина, см',
            'height' => 'Высота, см',
            'weight' => 'Вес, кг',
            'volume' => 'Объем, м',
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
            'is_draft' => 'Черновик',
            
            'userPhone' => 'Телефон',
            'userName' => 'Имя',
            'userSurname' => 'Фамилия',
            'payer' => 'Плательщик',
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
                ['html' => \Yii::$app->params['email'][$role]['cargo_one']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['cargo_one']['subject'])
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
