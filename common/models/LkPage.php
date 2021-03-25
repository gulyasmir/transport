<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%lk_page}}".
 *
 * @property int $id
 * @property string $text_info
 * @property string $text_cooperation
 * @property string $text_help
 */
class LkPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lk_page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_info', 'text_cooperation', 'text_help'], 'required'],
            [['text_info', 'text_cooperation', 'text_help'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_info' => 'Текст для вкладки Информация',
            'text_cooperation' => 'Текст для вкладки Условия сотрудничества',
            'text_help' => 'Текст для вкладки Справка',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\LkPageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\LkPageQuery(get_called_class());
    }
}
