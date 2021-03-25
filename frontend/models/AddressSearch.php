<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Address;

/**
 * AddressSearch represents the model behind the search form of `common\models\Address`.
 */
class AddressSearch extends Address
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address_id', 'user_id', 'create_date', 'type'], 'integer'],
            [['address', 'contact_person', 'phone'], 'string'],
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
        $query = Address::find();
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['address_id'=>SORT_DESC]]
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'address_id' => $this->address_id,
            'user_id' => \Yii::$app->user->identity->id,
            'create_date' => $this->create_date,
            'type' => $this->type,
        ]);
        
        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'phone', $this->phone]);
            
        $dataProvider->pagination->pageSize = 10;
        
        return $dataProvider;
    }
}
