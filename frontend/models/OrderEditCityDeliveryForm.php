<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Contact;

/**
 * OrderEditCityDelivery Form
 */
class OrderEditCityDeliveryForm extends Model
{
    public $address;
    public $city_delivery;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_delivery', 'address'], 'required'],
            [['city_delivery'], 'integer'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'address' => 'Адрес доставки',
            'city_delivery' => 'Доставка по городу',
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
                ['html' => \Yii::$app->params['email'][$role]['edit_city_delivery']['template']],
                ['model' => $this, 'user' => $user, 'contacts' => $contacts, 'order' => $order]
            )
            ->setTo($email)
            ->setFrom([\Yii::$app->params['fromEmail'] => \Yii::$app->params['fromName']])
            ->setSubject(\Yii::$app->params['email'][$role]['edit_city_delivery']['subject'])
        ->send();
    }
}
