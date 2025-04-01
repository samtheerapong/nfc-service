<?php

namespace app\modules\rawsauce\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rawsauce\models\StdSauce;

/**
 * StdSauceSearch represents the model behind the search form of `app\modules\rawsauce\models\StdSauce`.
 */
class StdSauceSearch extends StdSauce
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'sauce_type', 'std_ph', 'std_nacl', 'std_tn', 'std_color', 'std_alcohol', 'std_ppm', 'std_brix', 'remask'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = StdSauce::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sauce_type', $this->sauce_type])
            ->andFilterWhere(['like', 'std_ph', $this->std_ph])
            ->andFilterWhere(['like', 'std_nacl', $this->std_nacl])
            ->andFilterWhere(['like', 'std_tn', $this->std_tn])
            ->andFilterWhere(['like', 'std_color', $this->std_color])
            ->andFilterWhere(['like', 'std_alcohol', $this->std_alcohol])
            ->andFilterWhere(['like', 'std_ppm', $this->std_ppm])
            ->andFilterWhere(['like', 'std_brix', $this->std_brix])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
