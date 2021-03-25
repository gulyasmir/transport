<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_lk_change".
 *
 * @property int $id
 * @property string $page Страница
 * @property string $name_page Название страницы
 * @property string $text Текст
 * @property string $pdf Образец заявления
 */
class LkChange extends \yii\db\ActiveRecord
{

    public $filepdf1;
    public $old_pdf1;
    public $del_filepdf1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_lk_change';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
                [['filepdf1'], 'file', 'extensions'=>'jpg, gif, png, pdf, doc, docx, xls, xlsx'],
            [['page', 'name_page', 'pdf'], 'string', 'max' => 255],
            [['del_filepdf1'], 'boolean'],

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
            'text' => 'Текст',
            'pdf' => 'Образец заявления',
            'filepdf1' => 'Образец заявления',
            'del_filepdf1' => 'Удалить образец заявления (если загружаем новый образец)'
        ];
    }
}
