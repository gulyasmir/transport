<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Contact;

/**
 * OrderEditPickUp Form
 */
class OrderEditPickUpForm extends Model
{
    public $pick_up_date;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pick_up_date'], 'validateDate'],
            [['pick_up_date'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pick_up_date' => 'Когда забрать',
        ];
    }
    
    public function validateDate() {
        
        $currentDate = \Yii::$app->formatter->asTimestamp(date('d.m.Y'));
        $pick_up_date = \Yii::$app->formatter->asTimestamp($this->pick_up_date);
        
        if ($currentDate > $pick_up_date) {
            $this->addError('pick_up_date', 'Дата "Когда забрать" не может быть раньше текущей даты');
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
                ['html' => \Yii::$app->params['email'][$role]['edit_pick_up_date']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['edit_pick_up_date']['subject'])
        ->send();
    }
}
