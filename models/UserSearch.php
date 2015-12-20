<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'integer'],
            [['email', 'firstName', 'lastName', 'birthDay', 'password', 'info', 'authKey', 'token', 'image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();
         $sort = new Sort([
        'attributes' => [
            'email',
            'fullName' => [
                'asc' => ['lastName' => SORT_ASC, 'firstName' => SORT_ASC],
                'desc' => ['lastName' => SORT_DESC, 'firstName' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Full Name',
            ],
        ],
    ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'userId' => $this->userId,
            'birthDay' => $this->birthDay,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'authKey', $this->authKey])
            ->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
