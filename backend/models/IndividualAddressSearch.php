<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\IndividualAddress;

/**
 * IndividualAddressSearch represents the model behind the search form of `common\models\IndividualAddress`.
 */
class IndividualAddressSearch extends IndividualAddress
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['individual_address_id', 'address_id', 'identification', 'identification_series', 'identification_number'], 'integer'],
            [['full_name', 'country'], 'safe'],
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
        $query = IndividualAddress::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['individual_address_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'individual_address_id' => $this->individual_address_id,
            'address_id' => $this->address_id,
            'identification' => $this->identification,
            'identification_series' => $this->identification_series,
            'identification_number' => $this->identification_number,
            'identification_uvd' => $this->identification_uvd,
            'identification_date' => $this->identification_date,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}
