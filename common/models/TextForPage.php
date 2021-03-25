<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_text_for_page".
 *
 * @property int $id
 * @property string $page страница
 * @property string $name_page Название страницы
 * @property string $title_text заголовок для текста
 * @property string $text
 * @property string $title_seo заголовок для title страницы
 * @property string $description
 * @property string $keywords
 */
class TextForPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_text_for_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'title_text', 'text', 'title_seo', 'description', 'keywords'], 'required'],
            [['title_text', 'text'], 'string'],
            [['page', 'name_page', 'title_seo', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Страница',
            'name_page' => 'Название страницы',
            'title_text' => 'Заголовок для текста',
            'text' => 'Текст',
            'title_seo' => 'Заголовок для title страницы',
            'description' => 'Описание Description',
            'keywords' => 'Ключевые слова Keywords',
        ];
    }
}
