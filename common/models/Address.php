<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%address}}".
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'create_date', 'type'], 'integer'],
            [['phone'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 1000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'address_id' => 'ID',
            'user_id' => 'User ID',
            'create_date' => 'Дата создания',
            'type' => 'Отправитель или получатель',
            'contact_person' => 'Контактное лицо',
            'address' => 'Адрес',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityAddress()
    {
        return $this->hasOne(EntityAddress::className(), ['address_id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndividualAddress()
    {
        return $this->hasOne(IndividualAddress::className(), ['address_id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersSender()
    {
        return $this->hasMany(Order::className(), ['sender_id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersRecipient()
    {
        return $this->hasMany(Order::className(), ['recipient_id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersPayer()
    {
        return $this->hasMany(Order::className(), ['payer_id' => 'address_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\AddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\AddressQuery(get_called_class());
    }
}
