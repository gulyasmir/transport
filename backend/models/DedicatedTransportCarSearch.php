<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DedicatedTransportCar;

/**
 * DedicatedTransportCarSearch represents the model behind the search form of `common\models\DedicatedTransportCar`.
 */
class DedicatedTransportCarSearch extends DedicatedTransportCar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_car_id', 'load_capacity', 'hazard_class', 'city_pick_up', 'city_delivery', 'pick_up_date', 'from_address_loading', 'loading_operations', 'territory_entry', 'filling', 'hard_package', 'pallet_transparent', 'pallet_black', 'tent_remove_to', 'tent_remove_from', 'pallet_board_pack', 'is_draft'], 'integer'],
            [['cargo_params', 'from', 'to', 'status', 'userPhone', 'userName', 'userSurname', 'orderNumber'], 'safe'],
            [['declared_price'], 'number'],
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
        $query = DedicatedTransportCar::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['dt_car_id'=>SORT_DESC]]
        ]);
        
        $dataProvider->setSort([
            'attributes' => [
                'dt_car_id',
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
            'dt_car_id' => $this->dt_car_id,
            'load_capacity' => $this->load_capacity,
            'hazard_class' => $this->hazard_class,
            'declared_price' => $this->declared_price,
            'city_pick_up' => $this->city_pick_up,
            'city_delivery' => $this->city_delivery,
            'pick_up_date' => $this->pick_up_date,
            'from_address_loading' => $this->from_address_loading,
            'loading_operations' => $this->loading_operations,
            'territory_entry' => $this->territory_entry,
            'filling' => $this->filling,
            'hard_package' => $this->hard_package,
            'pallet_transparent' => $this->pallet_transparent,
            'pallet_black' => $this->pallet_black,
            'tent_remove_to' => $this->tent_remove_to,
            'tent_remove_from' => $this->tent_remove_from,
            'pallet_board_pack' => $this->pallet_board_pack,
            
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
