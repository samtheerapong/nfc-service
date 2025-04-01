<?php

namespace app\modules\tasks\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\MachineBom;

/**
 * MachineBomSearch represents the model behind the search form of `app\modules\tasks\models\MachineBom`.
 */
class MachineBomSearch extends MachineBom
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'machine_id', 'parent_part_id', 'child_part_id', 'quantity_required', 'level', 'status_id'], 'integer'],
            [['unit', 'bom_date'], 'safe'],
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
        $query = MachineBom::find();

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
            'machine_id' => $this->machine_id,
            'parent_part_id' => $this->parent_part_id,
            'child_part_id' => $this->child_part_id,
            'quantity_required' => $this->quantity_required,
            'level' => $this->level,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'bom_date', $this->bom_date]);

        return $dataProvider;
    }
}
