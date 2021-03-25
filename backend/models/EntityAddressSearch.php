<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EntityAddress;

/**
 * EntityAddressSearch represents the model behind the search form of `common\models\EntityAddress`.
 */
class EntityAddressSearch extends EntityAddress
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_address_id', 'address_id', 'legal_form_id', 'kpp' ], 'integer'],
            [['name', 'country', 'inn'], 'safe'],
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
        $query = EntityAddress::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['entity_address_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'entity_address_id' => $this->entity_address_id,
            'address_id' => $this->address_id,
            'legal_form_id' => $this->legal_form_id,
            'kpp'=> $this->kpp,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'inn', $this->inn]);

        return $dataProvider;
    }
}
