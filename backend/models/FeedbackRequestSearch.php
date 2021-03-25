<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FeedbackRequest;

/**
 * FeedbackRequestSearch represents the model behind the search form of `common\models\FeedbackRequest`.
 */
class FeedbackRequestSearch extends FeedbackRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['feedback_request_id', 'user_id', 'order_id', 'create_date', 'status'], 'integer'],
            [['title', 'comment', 'phone', 'email', 'contact_person'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = FeedbackRequest::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['status'=>SORT_ASC, 'create_date'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'feedback_request_id' => $this->feedback_request_id,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
            'create_date' => $this->create_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person]);

        return $dataProvider;
    }
}
