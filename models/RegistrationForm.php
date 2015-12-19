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
    public $passwordConfirm;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email','email','message' => Yii::t('app', '{attribute} is not a valid email.'), 
                    // 'when' => function($model) {
                    //     return $model->firstName == 'admin';
                    // },
                    // 'whenClient' => 'function(attribute,value) {
                    //     return $("#registrationform-firstname").val() == "admin";
                    // }'
                ],
            [
                ['email', 'passwordConfirm' ,'password','firstName', 'lastName'], 'required'
            ],
            [['email'],'unique', 'targetClass' => 'app\models\User'],
            ['password','compare','compareAttribute' => 'passwordConfirm' ],
            // [['firstName','lastName'],function($attribute, $params) {
            //     var_dump($this->{$attribute});
            //     var_dump(get_defined_vars());
            //     var_dump($this);
            //     $this->addError($attribute,Yii::t('app','Custom message'));
            // }],
            // [['firstName','lastName'],'checkInlineFunction']
        ];
    }

    // public function checkInlineFunction($attribute, $params) {
    //             var_dump($this->{$attribute});
    //             var_dump(get_defined_vars());
    //             var_dump($this);
    //             $this->addError($attribute,Yii::t('app','Custom 123 message'));
    //         }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            // $user->firstName = $this->firstName;
            // $user->lastName = $this->lastName;
            $user->email = $this->email;
            $user->password = $this->password;
            return $user->save();
        }
        return false;
    }
}
