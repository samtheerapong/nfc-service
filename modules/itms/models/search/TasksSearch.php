<?php

namespace app\modules\itms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\itms\models\Tasks;

/**
 * TasksSearch represents the model behind the search form of `app\modules\itms\models\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'department_id', 'status_id', 'task_year', 'task_month'], 'integer'],
            [['ref_code', 'title', 'description', 'task_date', 'user_request', 'remask'], 'safe'],
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
        $query = Tasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, // Use your timestamp column
                    // or 'id' => SORT_DESC if you want to sort by ID
                ]
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
            'type_id' => $this->type_id,
            'department_id' => $this->department_id,
            'status_id' => $this->status_id,
            'task_year' => $this->task_year,
            'task_month' => $this->task_month,
        ]);

        $query->andFilterWhere(['like', 'ref_code', $this->ref_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'task_date', $this->task_date])
            ->andFilterWhere(['like', 'user_request', $this->user_request])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
