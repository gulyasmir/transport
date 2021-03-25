<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContactShops;

/**
 * ContactShopsSearch represents the model behind the search form about `backend\models\ContactShops`.
 */
class ContactShopsSearch extends ContactShops
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'location', 'workingdays', 'weekend', 'adress', 'tel1', 'tel2', 'mail'], 'safe'],
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
        $query = ContactShops::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'workingdays', $this->workingdays])
            ->andFilterWhere(['like', 'weekend', $this->weekend])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'tel1', $this->tel1])
            ->andFilterWhere(['like', 'tel2', $this->tel2])
            ->andFilterWhere(['like', 'mail', $this->mail]);

        return $dataProvider;
    }
}
