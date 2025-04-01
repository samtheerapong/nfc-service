<?php

namespace app\modules\rawsauce\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rawsauce\models\RawSauceQuality;

/**
 * RawSauceQualitySearch represents the model behind the search form of `app\modules\rawsauce\models\RawSauceQuality`.
 */
class RawSauceQualitySearch extends RawSauceQuality
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'log_id'], 'integer'],
            [['qc_by', 'qc_date', 'sediment', 'color_value', 'color_ratio', 'nacl_value', 'ph_value', 'alcohol_value', 'tn_value', 'brix_value', 'ncr', 'remask', 'ref_code'], 'safe'],
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
        $query = RawSauceQuality::find();

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
            'log_id' => $this->log_id,
        ]);

        $query->andFilterWhere(['like', 'qc_by', $this->qc_by])
            ->andFilterWhere(['like', 'qc_date', $this->qc_date])
            ->andFilterWhere(['like', 'sediment', $this->sediment])
            ->andFilterWhere(['like', 'color_value', $this->color_value])
            ->andFilterWhere(['like', 'color_ratio', $this->color_ratio])
            ->andFilterWhere(['like', 'nacl_value', $this->nacl_value])
            ->andFilterWhere(['like', 'ph_value', $this->ph_value])
            ->andFilterWhere(['like', 'alcohol_value', $this->alcohol_value])
            ->andFilterWhere(['like', 'tn_value', $this->tn_value])
            ->andFilterWhere(['like', 'brix_value', $this->brix_value])
            ->andFilterWhere(['like', 'ncr', $this->ncr])
            ->andFilterWhere(['like', 'remask', $this->remask])
            ->andFilterWhere(['like', 'ref_code', $this->ref_code]);

        return $dataProvider;
    }
}
