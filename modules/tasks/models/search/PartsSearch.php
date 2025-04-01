<?php

namespace app\modules\tasks\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\Parts;

/**
 * PartsSearch represents the model behind the search form of `app\modules\tasks\models\Parts`.
 */
class PartsSearch extends Parts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'category_id', 'type_id', 'quantity_in_stock', 'min_stock', 'status_id'], 'integer'],
            [['code', 'name', 'description', 'location', 'serial_code', 'asset_code', 'last_install', 'unit', 'last_update', 'remask'], 'safe'],
            [['unit_cost'], 'number'],
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
        $query = Parts::find();

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
            'group_id' => $this->group_id,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'quantity_in_stock' => $this->quantity_in_stock,
            'unit_cost' => $this->unit_cost,
            'min_stock' => $this->min_stock,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'serial_code', $this->serial_code])
            ->andFilterWhere(['like', 'asset_code', $this->asset_code])
            ->andFilterWhere(['like', 'last_install', $this->last_install])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'last_update', $this->last_update])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
