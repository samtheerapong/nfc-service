<?php

namespace app\modules\itms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\itms\models\Computers;

/**
 * ComputersSearch represents the model behind the search form of `app\modules\itms\models\Computers`.
 */
class ComputersSearch extends Computers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'status_id'], 'integer'],
            [['asset_code', 'computer_name', 'brand', 'model', 'serial_number', 'purchase_date', 'warranty_expiry', 'cpu', 'ram', 'capacity_storage', 'lan', 'wifi', 'network_ip', 'nework_mac_addr', 'created_at', 'updated_at', 'ref_code'], 'safe'],
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
        $query = Computers::find();

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
            'profile_id' => $this->profile_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'asset_code', $this->asset_code])
            ->andFilterWhere(['like', 'computer_name', $this->computer_name])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'purchase_date', $this->purchase_date])
            ->andFilterWhere(['like', 'warranty_expiry', $this->warranty_expiry])
            ->andFilterWhere(['like', 'cpu', $this->cpu])
            ->andFilterWhere(['like', 'ram', $this->ram])
            ->andFilterWhere(['like', 'capacity_storage', $this->capacity_storage])
            ->andFilterWhere(['like', 'lan', $this->lan])
            ->andFilterWhere(['like', 'wifi', $this->wifi])
            ->andFilterWhere(['like', 'network_ip', $this->network_ip])
            ->andFilterWhere(['like', 'nework_mac_addr', $this->nework_mac_addr])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'ref_code', $this->ref_code]);

        return $dataProvider;
    }
}
