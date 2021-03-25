<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Payer Form
 */
class PayerForm extends Model
{
    public $sender_or_recipient;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_or_recipient'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sender_or_recipient' => 'Кем является плательщик',
        ];
    }
}
