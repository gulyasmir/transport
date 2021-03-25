<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TextForPage;

/**
 * TextForPageSearch represents the model behind the search form of `common\models\TextForPage`.
 */
class TextForPageSearch extends TextForPage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['page', 'name_page', 'title_text', 'text', 'title_seo', 'description', 'keywords'], 'safe'],
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
        $query = TextForPage::find();

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

        $query->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'name_page', $this->name_page])
            ->andFilterWhere(['like', 'title_text', $this->title_text])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'title_seo', $this->title_seo])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords]);

        return $dataProvider;
    }
}
