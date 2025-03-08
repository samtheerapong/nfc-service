<?php

namespace app\modules\tasks\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tasks\models\Teams;

/**
 * TeamsSearch represents the model behind the search form of `app\modules\tasks\models\Teams`.
 */
class TeamsSearch extends Teams
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'team_header', 'team_role', 'active'], 'integer'],
            [['name', 'team_email', 'api'], 'safe'],
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
        $query = Teams::find();

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
            'team_header' => $this->team_header,
            'team_role' => $this->team_role,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'team_email', $this->team_email])
            ->andFilterWhere(['like', 'api', $this->api]);

        return $dataProvider;
    }
}
