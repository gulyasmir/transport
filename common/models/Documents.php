<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%documents}}".

 */
class Documents extends \yii\db\ActiveRecord
{
    public $file;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%documents}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Выберите документ для загрузки'],
            [['title'], 'required'],
            [['name'], 'file', 'extensions'=>'jpg, gif, png, pdf, doc, docx, xls, xlsx'],
            [['user_id', 'order_id', 'create_date', 'uploader'], 'integer'],
            [['name'], 'string', 'max' => 500],
            [['order_id', 'user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'order_id', 'user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'document_id' => 'ID',
            'user_id' => 'Покупатель',
            'order_id' => 'Заказ',
            'create_date' => 'Дата создания',
            'name' => 'Файл',
            'title' => 'Название документа',
            'uploader' => 'Загрузил',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_id' => 'order_id', 'user_id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\queries\DocumentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\DocumentsQuery(get_called_class());
    }
    
    public function send_email($email, $role, $order) {
        
        if (!\Yii::$app->user->isGuest) {
            $user = \Yii::$app->user->identity;
        } else {
            $user = new User();
        }
        
        $contacts = Contact::findOne([
            'contact_id' => 1,
        ]);
        
        $mailer = \Yii::$app->mailer;
        $mailer->useFileTransport = false;
        return $mailer->compose(
                ['html' => \Yii::$app->params['email'][$role]['uploaded_document']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['uploaded_document']['subject'])
        ->send();
    }
}
