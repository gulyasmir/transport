<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Documents;

/**
 * DocumentsSearch represents the model behind the search form of `common\models\Documents`.
 */
class DocumentsSearch extends Documents
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_id', 'user_id', 'order_id', 'create_date', 'uploader'], 'integer'],
            [['title', 'name'], 'safe'],
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
        $query = Documents::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['document_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'document_id' => $this->document_id,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
            'create_date' => $this->create_date,
            'uploader' => $this->uploader,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
