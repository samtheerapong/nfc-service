<?php

namespace app\modules\itms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\itms\models\TaskActions;

/**
 * TaskActionsSearch represents the model behind the search form of `app\modules\itms\models\TaskActions`.
 */
class TaskActionsSearch extends TaskActions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cost'], 'integer'],
            [['task_code', 'action_code', 'process_fixed', 'comment', 'start_date', 'end_date', 'operator', 'item'], 'safe'],
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
        $query = TaskActions::find();

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
            'cost' => $this->cost,
        ]);

        $query->andFilterWhere(['like', 'task_code', $this->task_code])
            ->andFilterWhere(['like', 'action_code', $this->action_code])
            ->andFilterWhere(['like', 'process_fixed', $this->process_fixed])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'end_date', $this->end_date])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'item', $this->item]);

        return $dataProvider;
    }
}
