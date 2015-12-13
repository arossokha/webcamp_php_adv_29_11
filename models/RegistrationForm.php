<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegistrationForm is the model behind the login form.
 */
class RegistrationForm extends Model
{
    public $firstName;
    public $lastName;
    public $email;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password','firstName', 'lastName'], 'required'],
            ['email','email'],
            ['email','unique','targetClass' => 'app\models\User']
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User;
            $user->firstName = $this->firstName;
            $user->lastName = $this->lastName;
            $user->email = $this->email;
            $user->password = $this->password;
            return $user->save();
        }
        return false;
    }
}
