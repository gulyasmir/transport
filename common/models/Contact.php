<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property int $contact_id ID
 * @property string $phone Телефон
 * @property string $email Email
 * @property string $address Адрес
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'email'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => 'ID',
            'phone' => 'Телефон',
            'email' => 'Email',
            'address' => 'Адрес',
        ];
    }
}
