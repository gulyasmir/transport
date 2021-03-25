<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Contact;

/**
 * OrderEditContacts Form
 */
class OrderEditContactsForm extends Model
{
    public $phone;
    public $contact_person;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'contact_person'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Номер телефона',
            'contact_person' => 'Контактное лицо',
        ];
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
                ['html' => \Yii::$app->params['email'][$role]['edit_contacts']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['edit_contacts']['subject'])
        ->send();
    }
}
