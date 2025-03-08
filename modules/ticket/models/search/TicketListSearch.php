<?php

namespace app\modules\ticket\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ticket\models\TicketList;

/**
 * TicketListSearch represents the model behind the search form of `app\modules\ticket\models\TicketList`.
 */
class TicketListSearch extends TicketList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'location', 'quantity'], 'integer'],
            [['ticket_code', 'details', 'remask', 'ticket_date'], 'safe'],
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
        $query = TicketList::find();

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
            'location' => $this->location,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'ticket_code', $this->ticket_code])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'remask', $this->remask])
            ->andFilterWhere(['like', 'ticket_date', $this->ticket_date]);

        return $dataProvider;
    }
}
