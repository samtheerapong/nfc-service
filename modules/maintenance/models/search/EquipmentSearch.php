<?php

namespace app\modules\maintenance\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\maintenance\models\Equipment;

/**
 * EquipmentSearch represents the model behind the search form of `app\modules\maintenance\models\Equipment`.
 */
class EquipmentSearch extends Equipment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipment_id', 'type_id', 'status_id'], 'integer'],
            [['equipment_name', 'serial_number', 'purchase_date', 'warranty_end_date', 'location','asset_code'], 'safe'],
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
        $query = Equipment::find();

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
            'equipment_id' => $this->equipment_id,
            'type_id' => $this->type_id,
            'purchase_date' => $this->purchase_date,
            'warranty_end_date' => $this->warranty_end_date,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'equipment_name', $this->equipment_name])
            ->andFilterWhere(['like', 'asset_code', $this->asset_code])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}
