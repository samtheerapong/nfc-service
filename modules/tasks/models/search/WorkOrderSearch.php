<?php

namespace app\modules\tasks\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\WorkOrder;

/**
 * WorkOrderSearch represents the model behind the search form of `app\modules\tasks\models\WorkOrder`.
 */
class WorkOrderSearch extends WorkOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ticket_id', 'priority_id', 'teamwork', 'work_type_id'], 'integer'],
            [['work_order_code', 'work_detail', 'start_date', 'end_date', 'hours', 'cost', 'approve_name', 'approve_date', 'approve_comment'], 'safe'],
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
        $query = WorkOrder::find();

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
            'ticket_id' => $this->ticket_id,
            'priority_id' => $this->priority_id,
            'teamwork' => $this->teamwork,
            'work_type_id' => $this->work_type_id,
        ]);

        $query->andFilterWhere(['like', 'work_order_code', $this->work_order_code])
            ->andFilterWhere(['like', 'work_detail', $this->work_detail])
            ->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'end_date', $this->end_date])
            ->andFilterWhere(['like', 'hours', $this->hours])
            ->andFilterWhere(['like', 'cost', $this->cost])
            ->andFilterWhere(['like', 'approve_name', $this->approve_name])
            ->andFilterWhere(['like', 'approve_date', $this->approve_date])
            ->andFilterWhere(['like', 'approve_comment', $this->approve_comment]);

        return $dataProvider;
    }
}
