<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $userId
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property string $birthDay
 * @property string $password
 * @property string $info
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'firstName', 'lastName'], 'required'],
            [['birthDay'], 'safe'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['info'], 'string'],
            [['email'], 'string', 'max' => 255],
            [['firstName', 'lastName'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => Yii::t('app', 'User ID'),
            'email' => Yii::t('app', 'Email'),
            'firstName' => Yii::t('app', 'First Name'),
            'lastName' => Yii::t('app', 'Last Name'),
            'birthDay' => Yii::t('app', 'Birth Day'),
            'password' => Yii::t('app', 'Password'),
            'info' => Yii::t('app', 'Info'),
        ];
    }
}
