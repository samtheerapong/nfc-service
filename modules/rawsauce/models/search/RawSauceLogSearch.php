<?php

namespace app\modules\rawsauce\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rawsauce\models\RawSauceLog;

/**
 * RawSauceLogSearch represents the model behind the search form of `app\modules\rawsauce\models\RawSauceLog`.
 */
class RawSauceLogSearch extends RawSauceLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tank_id', 'current_value', 'sauce_type_id', 'incoming_value', 'outgoing_value'], 'integer'],
            [['ref_code', 'batch', 'record_by', 'updated_date', 'incoming_date', 'outgoing_date', 'remask'], 'safe'],
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
        $query = RawSauceLog::find();

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
            'tank_id' => $this->tank_id,
            'current_value' => $this->current_value,
            'sauce_type_id' => $this->sauce_type_id,
            'incoming_value' => $this->incoming_value,
            'outgoing_value' => $this->outgoing_value,
        ]);

        $query->andFilterWhere(['like', 'ref_code', $this->ref_code])
            ->andFilterWhere(['like', 'batch', $this->batch])
            ->andFilterWhere(['like', 'record_by', $this->record_by])
            ->andFilterWhere(['like', 'updated_date', $this->updated_date])
            ->andFilterWhere(['like', 'incoming_date', $this->incoming_date])
            ->andFilterWhere(['like', 'outgoing_date', $this->outgoing_date])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
