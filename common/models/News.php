<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $news_id ID
 * @property string $title Заголовок
 * @property string $text Текст
 * @property string $image Изображение
 * @property string $description Описание
 * @property string $keywords Ключевые слова
 * @property int $date Дата публикации
 */
class News extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'date'], 'required'],
            [['text'], 'string'],
            [['date'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['image', 'description', 'keywords'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'image' => 'Изображение',
            'description' => 'Описание description',
            'keywords' => 'Ключевые слова keywords',
            'date' => 'Дата публикации',
        ];
    }

    public function getFormattedDate(){
        return date('d.m.Y', $this->date);
    }
}
