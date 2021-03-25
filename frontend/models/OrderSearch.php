<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'sender_id', 'recipient_id', 'payer_id', 'create_date', 'status'], 'integer'],
            [['order_number', 'invoice', 'number_of_departure', 'from', 'to'], 'safe'],
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['order_id'=>SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'user_id' => \Yii::$app->user->identity->id,
            'sender_id' => $this->sender_id,
            'recipient_id' => $this->recipient_id,
            'payer_id' => $this->payer_id,
            'create_date' => $this->create_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'invoice', $this->invoice])
            ->andFilterWhere(['like', 'number_of_departure', $this->number_of_departure])
            ->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'to', $this->to]);
            
       // $query->andFilterWhere(['!=', 'status', 0]);
         $query->andFilterWhere(['like', 'status', $this->status]);
         
        $dataProvider->pagination->pageSize = 10;
        
        return $dataProvider;
    }
}
