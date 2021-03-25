<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sender_id', 'recipient_id', 'payer_id'], 'required'],
            [['user_id', 'sender_id', 'recipient_id', 'payer_id', 'create_date', 'status', 'route_length', 'calculated_price', 'real_price'], 'integer'],
            [['order_number'], 'string', 'max' => 100],
            [['invoice'], 'string', 'max' => 500],
            [['number_of_departure'], 'string', 'max' => 45],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['sender_id' => 'address_id']],
            [['recipient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['recipient_id' => 'address_id']],
            [['payer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['payer_id' => 'address_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'ID',
            'user_id' => 'Покупатель',
            'sender_id' => 'Отправитель',
            'recipient_id' => 'Поулчатель',
            'payer_id' => 'Плательщик',
            'create_date' => 'Дата создания',
            'order_number' => 'Номер заказа',
            'invoice' => 'Накладная',
            'number_of_departure' => 'Номер отправления',
            'from' => 'Откуда',
            'to' => 'Куда',
            'status' => 'Статус заказа',
            'route_length' => 'Расстояние',
             'calculated_price'  => 'Расчетная цена, руб.',
             'real_price' => 'Реальная цена, руб.'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDedicatedTransportCar()
    {
        return $this->hasOne(DedicatedTransportCar::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDedicatedTransportTruck()
    {
        return $this->hasOne(DedicatedTransportTruck::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentRequests()
    {
        return $this->hasMany(DocumentRequest::className(), ['order_id' => 'order_id', 'user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['order_id' => 'order_id', 'user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackRequests()
    {
        return $this->hasMany(FeedbackRequest::className(), ['order_id' => 'order_id', 'user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneralCargoLetter()
    {
        return $this->hasOne(GeneralCargoLetter::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneralCargoManyPlace()
    {
        return $this->hasOne(GeneralCargoManyPlaces::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneralCargoOnePlace()
    {
        return $this->hasOne(GeneralCargoOnePlace::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(Address::className(), ['address_id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient()
    {
        return $this->hasOne(Address::className(), ['address_id' => 'recipient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayer()
    {
        return $this->hasOne(Address::className(), ['address_id' => 'payer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\OrderQuery(get_called_class());
    }
}
