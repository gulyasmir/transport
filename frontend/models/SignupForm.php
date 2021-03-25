<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $confirm_password;
    public $email;
    public $name;
    public $surname;
    public $patronymic;
    public $phone;
    public $inn;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким логином уже зарегистрирован.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким email уже зарегистрирован.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['confirm_password', 'required'],
            ['confirm_password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Пароли не совпадают."],
            
            ['name', 'required'],
            
            ['surname', 'required'],
            
            ['phone', 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'confirm_password' => 'Повтор пароля',
            'email' => 'Email',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'phone' => 'Телефон',
            'inn' => 'ИНН',
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        $user->email = $this->email;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->patronymic = $this->patronymic;
        $user->phone = $this->phone;
        $user->inn = $this->inn;
        
        $user->status = 10;
        $user->role = 1;
        $user->created_at = time();
        $user->updated_at = $user->created_at;
        
        return $user->save() ? $user : null;
    }
}
