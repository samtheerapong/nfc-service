<?php

namespace app\modules\rawsauce\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rawsauce\models\RawSauceTransfer;

/**
 * RawSauceTransferSearch represents the model behind the search form of `app\modules\rawsauce\models\RawSauceTransfer`.
 */
class RawSauceTransferSearch extends RawSauceTransfer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'incoming_tank', 'incoming_value', 'outgoing_tank', 'outgoing_value'], 'integer'],
            [['log_id', 'incoming_date', 'outgoing_date', 'ref_code'], 'safe'],
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
        $query = RawSauceTransfer::find();

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
            'incoming_tank' => $this->incoming_tank,
            'incoming_value' => $this->incoming_value,
            'outgoing_tank' => $this->outgoing_tank,
            'outgoing_value' => $this->outgoing_value,
        ]);

        $query->andFilterWhere(['like', 'log_id', $this->log_id])
            ->andFilterWhere(['like', 'incoming_date', $this->incoming_date])
            ->andFilterWhere(['like', 'outgoing_date', $this->outgoing_date])
            ->andFilterWhere(['like', 'ref_code', $this->ref_code]);

        return $dataProvider;
    }
}
