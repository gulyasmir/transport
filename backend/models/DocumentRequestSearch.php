<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DocumentRequest;

/**
 * DocumentRequestSearch represents the model behind the search form of `common\models\DocumentRequest`.
 */
class DocumentRequestSearch extends DocumentRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_request_id', 'user_id', 'order_id', 'create_date', 'date_from', 'date_to', 'send_post', 'send_email', 'status'], 'integer'],
            [['contact_person', 'phone', 'email', 'comment'], 'safe'],
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
        $query = DocumentRequest::find();

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
            'document_request_id' => $this->document_request_id,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
            'create_date' => $this->create_date,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'send_post' => $this->send_post,
            'send_email' => $this->send_email,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
