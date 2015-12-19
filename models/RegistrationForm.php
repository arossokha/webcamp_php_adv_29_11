<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegistrationForm is the model behind the login form.
 */
class RegistrationForm extends Model
{
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
                ['email', 'passwordConfirm' ,'password'], 
                'required'
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
            $user->setScenario(User::SCENARIO_REGISTER);
            $user->email = $this->email;
            $user->password = $this->password;
            $saveResult = $user->save();
            if(!$saveResult) {
                /**
                 * @todo: remove when you need to use this on real server
                 */
                var_dump($user->getErrors());
                die();
            }
            return $saveResult;
        }
        return false;
    }
}
