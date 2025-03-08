<?php

namespace app\modules\tasks\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\Technician;

/**
 * TechnicianSearch represents the model behind the search form of `app\modules\tasks\models\Technician`.
 */
class TechnicianSearch extends Technician
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'role_id'], 'integer'],
            [['ref', 'thainame', 'tel', 'email', 'api', 'active'], 'safe'],
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
        $query = Technician::find();

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
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
        ]);

        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'thainame', $this->thainame])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'api', $this->api])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
