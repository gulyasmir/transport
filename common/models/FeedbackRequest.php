<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%feedback_request}}".
 */
class FeedbackRequest extends \yii\db\ActiveRecord
{
    public $response;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%feedback_request}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id'], 'required'],
            [['contact_person', 'phone', 'email', 'comment', 'title'], 'required'],
            [['user_id', 'order_id', 'create_date', 'status'], 'integer'],
            [['comment'], 'string'],
            [['title'], 'string', 'max' => 1000],
            [['order_id', 'user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'order_id', 'user_id' => 'user_id']],
            [['response'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'feedback_request_id' => 'ID',
            'user_id' => 'Покупатель',
            'order_id' => 'Заказ',
            'create_date' => 'Дата создания',
            'contact_person' => 'Контактное лицо',
            'title' => 'Заголовок',
            'comment' => 'Комментарий',
            'email' => 'Email',
            'phone' => 'Телефон',
            'status' => 'Статус',
            
            'response' => 'Написать ответ',
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
     * @return \common\models\queries\FeedbackRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\FeedbackRequestQuery(get_called_class());
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
                ['html' => \Yii::$app->params['email'][$role]['feedback_request']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['feedback_request']['subject'])
        ->send();
    }
    
    public function send_email_response($email, $order) {
        
        $contacts = Contact::findOne([
            'contact_id' => 1,
        ]);
        
        $mailer = \Yii::$app->mailer;
        $mailer->useFileTransport = false;
        return $mailer->compose(
                ['html' => \Yii::$app->params['email']['user']['feedback_request_response']['template']],
                ['model' => $this, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email']['user']['feedback_request_response']['subject'])
        ->send();
    }
}
