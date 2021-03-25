<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%entity_address}}".
 */
class EntityAddress extends \yii\db\ActiveRecord
{
    public $contact_person;
    public $phone;
    public $aaddress;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%entity_address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address_id', 'legal_form_id', 'kpp'], 'integer'],
            [['inn'], 'string', 'max' => 100],
            [['country', 'name'], 'string', 'max' => 500],
            [['legal_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => LegalForm::className(), 'targetAttribute' => ['legal_form_id' => 'legal_form_id']],
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
            'entity_address_id' => 'ID',
            'address_id' => 'Адрес',
            'legal_form_id' => 'Правовая форма',
            'inn' => 'Инн',
            'country' => 'Страна',
            'name' => 'Наименование организации',
            'kpp' => 'КПП',

            'contact_person' => 'Контактное лицо',
            'phone' => 'Телефон',
            'aaddress' => 'Адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLegalForm()
    {
        return $this->hasOne(LegalForm::className(), ['legal_form_id' => 'legal_form_id']);
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
     * @return \common\models\queries\EntityAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\EntityAddressQuery(get_called_class());
    }
}
