<?php

namespace app\modules\tasks\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\ticket;

/**
 * TicketSearch represents the model behind the search form of `app\modules\ticket\models\ticket`.
 */
class TicketSearch extends ticket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ticket_group', 'status_id', 'priority_id'], 'integer'],
            [['ticket_code', 'ticket_date', 'title', 'description', 'remask', 'request_by', 'created_at', 'approve_name', 'approve_date', 'approve_comment', 'location', 'broken_date'], 'safe'],
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
        $query = ticket::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 16,
            ],
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
            'ticket_group' => $this->ticket_group,
            'status_id' => $this->status_id,
            'priority_id' => $this->priority_id,
        ]);

        $query->andFilterWhere(['like', 'ticket_code', $this->ticket_code])
            ->andFilterWhere(['like', 'ticket_date', $this->ticket_date])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'remask', $this->remask])
            ->andFilterWhere(['like', 'request_by', $this->request_by])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'approve_name', $this->approve_name])
            ->andFilterWhere(['like', 'approve_date', $this->approve_date])
            ->andFilterWhere(['like', 'broken_date', $this->broken_date])
            ->andFilterWhere(['like', 'approve_comment', $this->approve_comment]);

        return $dataProvider;
    }
}
