<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Terms Form
 */
class TermsForm extends Model
{
    public $terms;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['terms'], 'compare', 'compareValue' => 0, 'operator' => '>', 'message' => 'Подтвердите что ознакомлены с условиями.'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'terms' => 'Подтверждаю что ознакомлен с условиями',
        ];
    }
}
