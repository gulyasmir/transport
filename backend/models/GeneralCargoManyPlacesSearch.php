<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GeneralCargoManyPlaces;

/**
 * GeneralCargoManyPlacesSearch represents the model behind the search form of `common\models\GeneralCargoManyPlaces`.
 */
class GeneralCargoManyPlacesSearch extends GeneralCargoManyPlaces
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gc_many_places_id', 'user_id', 'place_quantity', 'hazard_class', 'city_pick_up', 'city_delivery', 'pick_up_date', 'from_address_loading', 'loading_operations', 'territory_entry', 'is_draft'], 'integer'],
            [['biggest_length', 'biggest_width', 'biggest_height', 'overall_volume', 'overall_weight', 'declared_price'], 'number'],
            [['cargo_params', 'from', 'to', 'status', 'userPhone', 'userName', 'userSurname', 'orderNumber'], 'safe'],
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
        $query = GeneralCargoManyPlaces::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['gc_many_places_id'=>SORT_DESC]]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'gc_many_places_id',
                'pick_up_date',
                'from' => [
                    'asc' => ['{{%order}}.from' => SORT_ASC],
                    'desc' => ['{{%order}}.from' => SORT_DESC],
                    'label' => 'Откуда',
                ],
                'to' => [
                    'asc' => ['{{%order}}.to' => SORT_ASC],
                    'desc' => ['{{%order}}.to' => SORT_DESC],
                    'label' => 'Куда',
                ],
                'status' => [
                    'asc' => ['{{%order}}.status' => SORT_ASC],
                    'desc' => ['{{%order}}.status' => SORT_DESC],
                    'label' => 'Статус',
                ],
                'orderNumber' => [
                    'asc' => ['{{%order}}.order_number' => SORT_ASC],
                    'desc' => ['{{%order}}.order_number' => SORT_DESC],
                    'label' => 'Номер заказа',
                ],
                'userName' => [
                    'asc' => ['{{%user}}.name' => SORT_ASC],
                    'desc' => ['{{%user}}.name' => SORT_DESC],
                    'label' => 'Имя',
                ],
                'userSurname' => [
                    'asc' => ['{{%user}}.surname' => SORT_ASC],
                    'desc' => ['{{%user}}.surname' => SORT_DESC],
                    'label' => 'Фамилия',
                ],
                'userPhone' => [
                    'asc' => ['{{%user}}.phone' => SORT_ASC],
                    'desc' => ['{{%user}}.phone' => SORT_DESC],
                    'label' => 'Телефон',
                ],
            ]
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            
            $query->joinWith(['order']);
            $query->joinWith(['user']);
            
            // Фильтр по заказам (не черновикам)
            $query->andFilterWhere(['!=', 'is_draft', 1]);
            $query->joinWith(['order' => function ($q) {
                $q->andWhere('{{%order}}.status != 0');
            }]);
            
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'gc_many_places_id' => $this->gc_many_places_id,
            'biggest_length' => $this->biggest_length,
            'biggest_width' => $this->biggest_width,
            'biggest_height' => $this->biggest_height,
            'place_quantity' => $this->place_quantity,
            'overall_volume' => $this->overall_volume,
            'overall_weight' => $this->overall_weight,
            'hazard_class' => $this->hazard_class,
            'declared_price' => $this->declared_price,
            'city_pick_up' => $this->city_pick_up,
            'city_delivery' => $this->city_delivery,
            'pick_up_date' => $this->pick_up_date,
            'from_address_loading' => $this->from_address_loading,
            'loading_operations' => $this->loading_operations,
            'territory_entry' => $this->territory_entry,
            
            // Фильтр по заказам (не черновикам)
            'is_draft' => 0,
        ]);
        
        // Фильтр по заказам (не черновикам)
        $query->andFilterWhere(['!=', 'is_draft', 1]);
        $query->joinWith(['order' => function ($q) {
            $q->andWhere('{{%order}}.status != 0');
        }]);
        
        $query->andFilterWhere(['like', 'cargo_params', $this->cargo_params]);
        
        if ($this->orderNumber) {
            $query->joinWith(['order' => function ($q) {
                $q->andWhere('{{%order}}.order_number LIKE "%' . $this->orderNumber . '%"');
            }]);
        }
        if ($this->from) {
            $query->joinWith(['order' => function ($q) {
                $q->andWhere('{{%order}}.from LIKE "%' . $this->from . '%"');
            }]);
        }
        if ($this->to) {
            $query->joinWith(['order' => function ($q) {
                $q->andWhere('{{%order}}.to LIKE "%' . $this->to . '%"');
            }]);
        }
        if ($this->status) {
            $query->joinWith(['order' => function ($q) {
                $q->andWhere('{{%order}}.status = "' . $this->status . '"');
            }]);
        }
        if ($this->userName) {
            $query->joinWith(['user' => function ($q) {
                $q->andWhere('{{%user}}.name LIKE "%' . $this->userName . '%"');
            }]);
        }
        if ($this->userSurname) {
            $query->joinWith(['user' => function ($q) {
                $q->andWhere('{{%user}}.surname LIKE "%' . $this->userSurname . '%"');
            }]);
        }
        if ($this->userPhone) {
            $query->joinWith(['user' => function ($q) {
                $q->andWhere('{{%user}}.phone LIKE "%' . $this->userPhone . '%"');
            }]);
        }
        
        return $dataProvider;
    }
}
