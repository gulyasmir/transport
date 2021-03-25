<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Contact;

/**
 * OrderEditAddress Form
 */
class OrderEditAddressForm extends Model
{
    public $address;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'address' => 'Адрес доставки',
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
                ['html' => \Yii::$app->params['email'][$role]['edit_address']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['edit_address']['subject'])
        ->send();
    }
}
