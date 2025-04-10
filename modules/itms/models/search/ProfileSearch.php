<?php

namespace app\modules\itms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\itms\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\modules\itms\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'title_name', 'department_id', 'role_id', 'pdpa', 'status_id'], 'integer'],
            [['thai_name', 'english_name', 'nickname', 'date_of_birth', 'start_date', 'position', 'email', 'line_id', 'phone_number', 'employee_id', 'reason', 'created_at', 'updated_at', 'leave_date', 'approve_name', 'approve_date', 'ref_code'], 'safe'],
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
        $query = Profile::find();

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
            'title_name' => $this->title_name,
            'department_id' => $this->department_id,
            'role_id' => $this->role_id,
            'pdpa' => $this->pdpa,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'thai_name', $this->thai_name])
            ->andFilterWhere(['like', 'english_name', $this->english_name])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth])
            ->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'line_id', $this->line_id])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'leave_date', $this->leave_date])
            ->andFilterWhere(['like', 'approve_name', $this->approve_name])
            ->andFilterWhere(['like', 'approve_date', $this->approve_date])
            ->andFilterWhere(['like', 'ref_code', $this->ref_code]);

        return $dataProvider;
    }
}
