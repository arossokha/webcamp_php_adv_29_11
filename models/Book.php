<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Book".
 *
 * @property integer $bookId
 * @property string $name
 * @property integer $year
 * @property integer $userId
 *
 * @property User $user
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year','name'],'required'],
            [['year', 'userId'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bookId' => Yii::t('app', 'Book ID'),
            'name' => Yii::t('app', 'Name'),
            'year' => Yii::t('app', 'Year'),
            'userId' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    public function beforeSave() {
        if(parent::beforeSave($insert)) {
            if(!$this->userId) {
                $this->userId = Yii::$app->user->getId();
            }
            return true;
        }
        
        return false;
    }
}
