<?php

namespace app\modules\stock\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\stock\models\PurchaseOrder;

/**
 * PurchaseOrderSearch represents the model behind the search form of `app\modules\stock\models\PurchaseOrder`.
 */
class PurchaseOrderSearch extends PurchaseOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'equipment_id', 'quantity'], 'integer'],
            [['status', 'created_at', 'ordered_at', 'received_at'], 'safe'],
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
        $query = PurchaseOrder::find();

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
            'equipment_id' => $this->equipment_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'ordered_at' => $this->ordered_at,
            'received_at' => $this->received_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
