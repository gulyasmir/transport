<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Calculation Form
 */
class SearchForm extends Model
{
    public $tracking_number;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tracking_number'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tracking_number' => '№ накладной',
        ];
    }
}
