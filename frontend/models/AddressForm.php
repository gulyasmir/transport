<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\LegalForm;

/**
 * Address Form
 */
class AddressForm extends Model
{
    public $individual_entity;

    public $individual_full_name;
    public $individual_country;
    public $individual_identification;
    public $individual_identification_series;
    public $individual_identification_number;

    public $individual_identification_uvd;
    public $individual_identification_date;


    public $individual_address;
    public $individual_contact_person;
    public $individual_phone;

    public $entity_name;
    public $entity_inn;

    public $entity_kpp;

    public $entity_legal_form_id;
    public $entity_country;
    public $entity_address;
    public $entity_contact_person;
    public $entity_phone;

    public $address_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['individual_entity'], 'required'],
            [['individual_full_name', 'individual_full_name', 'individual_country', 'individual_address', 'individual_identification', 'individual_identification_series', 'individual_identification_number','individual_identification_uvd', 'individual_identification_date', 'individual_contact_person', 'individual_phone'], 'required'],
            [['entity_legal_form_id', 'entity_inn', 'entity_country', 'entity_name', 'entity_address', 'entity_contact_person', 'entity_phone'], 'required'],
            [['address_id'], 'required', 'message' => 'Выберите адрес из списка.'],

            [['individual_full_name', 'individual_country', 'individual_contact_person', 'entity_country', 'entity_name', 'entity_contact_person'], 'string', 'max' => 500],
            [['individual_phone', 'entity_inn','entity_kpp', 'entity_phone'], 'string', 'max' => 100],
            [['entity_legal_address'], 'string', 'max' => 1000],

          //  [['kpp'], 'integer'],

            [['legal_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => LegalForm::className(), 'targetAttribute' => ['legal_form_id' => 'legal_form_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'individual_entity' => 'Выбор формы юр физ лицо',

            'individual_full_name' => 'ФИО',
            'individual_country' => 'Страна',
            'individual_identification' => 'Документ',
            'individual_identification_series' => 'Серия документа',
            'individual_identification_number' => 'Номер документа',

            'individual_identification_uvd' => 'Кем выдан',
            'individual_identification_date'=> 'Когда выдан',


            'individual_address' => 'Адрес',
            'individual_contact_person' => 'Контактное лицо',
            'individual_phone' => 'Телефон',

            'entity_legal_form_id' => 'Правовая форма',
            'entity_inn' => 'Инн',
            'entity_kpp' => 'КПП',
            'entity_country' => 'Страна',
            'entity_name' => 'Наименование организации',
            'entity_address' => 'Юр адрес',
            'entity_contact_person' => 'Контактное лицо',
            'entity_phone' => 'Телефон',

            'address_id' => 'Выбранный адрес',
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();

        $scenarios['individual'] = ['individual_entity','individual_full_name', 'individual_country', 'individual_address', 'individual_identification', 'individual_identification_series', 'individual_identification_number', 'individual_identification_uvd', 'individual_identification_date', 'individual_contact_person', 'individual_phone'];
        $scenarios['entity'] = ['individual_entity','entity_legal_form_id', 'entity_inn','entity_kpp',  'entity_country', 'entity_name', 'entity_address', 'entity_contact_person', 'entity_phone',];
        $scenarios['address'] = ['individual_entity', 'address_id'];

        return $scenarios;
    }
}
