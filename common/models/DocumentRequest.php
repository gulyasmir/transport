<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%document_request}}".
 */
class DocumentRequest extends \yii\db\ActiveRecord
{
    public $response;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%document_request}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_to'], 'validateToDate'],
            [['date_from'], 'validateFromDate'],
            [['date_from', 'date_to', 'contact_person', 'phone', 'email'/*, 'comment'*/], 'required'],
            [['user_id', 'order_id', 'create_date', 'send_post', 'send_email', 'status'], 'integer'],
            [['comment', 'post_adress'], 'string'],
            [['contact_person', 'email'], 'string', 'max' => 500],
            [['phone'], 'string', 'max' => 100],
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
            'document_request_id' => 'ID',
            'user_id' => 'Покупатель',
            'order_id' => 'Заказ',
            'create_date' => 'Дата создания',
            'date_from' => 'Дата от',
            'date_to' => 'Дата по',
            'contact_person' => 'Контактное лицо',
            'phone' => 'Телефон',
            'email' => 'Email',
            'comment' => 'Комментарий',
            'send_post' => 'Отправить почтой',
            'send_email' => 'Отправить на email',
            'status' => 'Статус',
            'post_adress' => 'Почтовый адрес',
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
     * @return \common\models\queries\DocumentRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\queries\DocumentRequestQuery(get_called_class());
    }

    public function validateFromDate() {

        $date_from = \Yii::$app->formatter->asTimestamp($this->date_from);
        $date_to = \Yii::$app->formatter->asTimestamp($this->date_to);

        if ($date_to < $date_from) {
            $this->addError('date_from', '"Дата от" не может быть больше "Даты по"');
        }
    }

    public function validateToDate() {

        $date_from = \Yii::$app->formatter->asTimestamp($this->date_from);
        $date_to = \Yii::$app->formatter->asTimestamp($this->date_to);

        if ($date_to < $date_from) {
            $this->addError('date_to', '"Дата по" не может быть меньше "Даты от"');
        }
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
                ['html' => \Yii::$app->params['email'][$role]['documents_request']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['documents_request']['subject'])
        ->send();
    }

    public function send_email_response($email, $order) {

        $contacts = Contact::findOne([
            'contact_id' => 1,
        ]);

        $mailer = \Yii::$app->mailer;
        $mailer->useFileTransport = false;
        return $mailer->compose(
                ['html' => \Yii::$app->params['email']['user']['documents_request_response']['template']],
                ['model' => $this, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email']['user']['documents_request_response']['subject'])
        ->send();
    }
}
