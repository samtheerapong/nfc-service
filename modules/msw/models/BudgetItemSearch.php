<?php

namespace app\modules\msw\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\msw\models\BudgetItem;

/**
 * BudgetItemSearch represents the model behind the search form of `app\modules\msw\models\BudgetItem`.
 */
class BudgetItemSearch extends BudgetItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'budget_id'], 'integer'],
            [['category', 'sub_category', 'note', 'created_at', 'updated_at'], 'safe'],
            [['amount_allocated', 'amount_used'], 'number'],
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
        $query = BudgetItem::find();

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
            'budget_id' => $this->budget_id,
            'amount_allocated' => $this->amount_allocated,
            'amount_used' => $this->amount_used,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'sub_category', $this->sub_category])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
