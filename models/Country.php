<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property integer $population
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer'],
            ['code', 'unique'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 52]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'population' => Yii::t('app', 'Population'),
        ];
    }

    public function getNameText() {
        return strtoupper($this->name);
    }

    public function beforeSave($insert) {
        if(parent::beforeSave($insert)) {
            if(10000 > $this->population) {
                $this->population = 10000;
            }
            return true;
        }
        
        return false;
    }
}
