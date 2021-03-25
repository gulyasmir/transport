<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Calculation Form
 */
class CalculationForm extends Model
{
    public $from;
    public $to;
    public $city_pick_up;
    public $city_delivery;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'from' => 'Откуда',
            'to' => 'Куда',
            'city_pick_up' => 'Забрать по городу',
            'city_delivery' => 'Доставка по городу',
        ];
    }
}
