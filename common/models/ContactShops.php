<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "svet_contact_shops".
 *
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property string $workingdays
 * @property string $weekend
 * @property string $adress
 * @property string $tel1
 * @property string $tel2
 * @property string $mail
 */
class ContactShops extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_contact_shops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location', 'workingdays', 'weekend', 'adress', 'tel1', 'tel2', 'mail'], 'required'],
            [['adress'], 'string'],
            [['name', 'location', 'workingdays', 'weekend', 'tel1', 'tel2', 'mail'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'location' => 'Широта, Долгота',
            'workingdays' => 'Рабочие дни',
            'weekend' => 'Выходные',
            'adress' => 'Адрес',
            'tel1' => 'Телефон 1',
            'tel2' => 'Телефон 2',
            'mail' => 'Email',
        ];
    }
}
