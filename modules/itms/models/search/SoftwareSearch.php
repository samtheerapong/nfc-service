<?php

namespace app\modules\itms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\itms\models\Software;

/**
 * SoftwareSearch represents the model behind the search form of `app\modules\itms\models\Software`.
 */
class SoftwareSearch extends Software
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'software_id', 'computer_id', 'status_id'], 'integer'],
            [['asset_code', 'software_name', 'description', 'version', 'license_key', 'installation_date', 'expiry_date', 'created_at', 'updated_at', 'ref_code'], 'safe'],
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
        $query = Software::find();

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
            'software_id' => $this->software_id,
            'computer_id' => $this->computer_id,
            'installation_date' => $this->installation_date,
            'expiry_date' => $this->expiry_date,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'asset_code', $this->asset_code])
            ->andFilterWhere(['like', 'software_name', $this->software_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'version', $this->version])
            ->andFilterWhere(['like', 'license_key', $this->license_key])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'ref_code', $this->ref_code]);

        return $dataProvider;
    }
}
