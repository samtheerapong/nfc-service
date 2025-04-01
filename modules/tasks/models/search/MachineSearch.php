<?php

namespace app\modules\tasks\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\Machine;

/**
 * MachineSearch represents the model behind the search form of `app\modules\tasks\models\Machine`.
 */
class MachineSearch extends Machine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'quantity_in_stock', 'status_id'], 'integer'],
            [['code', 'name', 'description', 'serial_code', 'asset_code', 'location', 'last_install', 'cost', 'unit', 'last_update', 'remask'], 'safe'],
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
        $query = Machine::find();

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
            'type_id' => $this->type_id,
            'quantity_in_stock' => $this->quantity_in_stock,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'serial_code', $this->serial_code])
            ->andFilterWhere(['like', 'asset_code', $this->asset_code])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'last_install', $this->last_install])
            ->andFilterWhere(['like', 'cost', $this->cost])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'last_update', $this->last_update])
            ->andFilterWhere(['like', 'remask', $this->remask]);

        return $dataProvider;
    }
}
