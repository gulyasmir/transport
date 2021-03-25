<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_rate".
 *
 * @property int $id
 * @property string $type Тип доставки
 * @property int $delivery_tariff Стоимость за км
 * @property int $minimum_cost Минимальная общая стоимость
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
          return '{{%rate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'delivery_tariff', 'minimum_cost','constant'], 'required'],
            [['delivery_tariff', 'minimum_cost','constant'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип доставки',
            'delivery_tariff' => 'Стоимость за км',
            'minimum_cost' => 'Минимальная общая стоимость',
            'constant' => 'Добавляемая константа',
        ];
    }
}
