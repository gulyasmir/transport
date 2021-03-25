<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%individual_address}}".
 */
class IndividualAddress extends \yii\db\ActiveRecord
{
    public $contact_person;
    public $phone;
    public $aaddress;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%individual_address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address_id', 'identification', 'identification_series', 'identification_number'], 'integer'],
            [['full_name', 'country', 'identification_uvd', 'identification_date'], 'string', 'max' => 500],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'address_id']],
            [['contact_person', 'phone', 'aaddress'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'individual_address_id' => 'ID',
            'address_id' => 'Адрес',
            'full_name' => 'ФИО',
            'country' => 'Страна',
            'identification' => 'Документ',
            'identification_series' => 'Серия документа',
            'identification_number' => 'Номер документа',
 'identification_uvd' => 'Кем выдан',
 'identification_date'=> 'Когда выдан',

            'contact_person' => 'Контактное лицо',
            'phone' => 'Телефон',
            'aaddress' => 'Адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['address_id' => 'address_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\IndividualAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\IndividualAddressQuery(get_called_class());
    }
}
