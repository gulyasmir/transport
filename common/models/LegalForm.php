<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%legal_form}}".
 *
 * @property int $legal_form_id ID
 * @property int $create_date Дата создания
 * @property string $name Название
 *
 * @property EntityAddress[] $entityAddresses
 */
class LegalForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%legal_form}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_date'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'legal_form_id' => 'ID',
            'create_date' => 'Дата создания',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityAddresses()
    {
        return $this->hasMany(EntityAddress::className(), ['legal_form_id' => 'legal_form_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\LegalFormQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\LegalFormQuery(get_called_class());
    }
}
