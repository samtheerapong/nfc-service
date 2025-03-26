<?php

namespace app\modules\stock\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\stock\models\Requisition;

/**
 * RequisitionSearch represents the model behind the search form of `app\modules\stock\models\Requisition`.
 */
class RequisitionSearch extends Requisition
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'equipment_id', 'quantity', 'status_id'], 'integer'],
            [['user_name', 'created_at', 'approved_by', 'approved_at'], 'safe'],
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
        $query = Requisition::find();

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
            'equipment_id' => $this->equipment_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'approved_at' => $this->approved_at,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'approved_by', $this->approved_by]);

        return $dataProvider;
    }
}
