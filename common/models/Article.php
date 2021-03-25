<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $article_id ID
 * @property string $title Заголовок
 * @property string $text Текст
 * @property string $image Изображение
 * @property string $description Описание
 * @property string $keywords Ключевые слова
 * @property int $date Дата публикации
 * @property int $view Активна
 */
class Article extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['date', 'view'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['description', 'keywords'], 'string', 'max' => 1000],
            [['image'], 'file', 'extensions' => 'gif, jpg, jpeg, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'image' => 'Изображение',
            'description' => 'Описание description',
            'keywords' => 'Ключевые слова keywords',
            'date' => 'Дата публикации',
            'view' => 'Тип отображения',
        ];
    }

    public function getFormattedDate() {
        return date('d.m.Y', $this->date);
    }
}
