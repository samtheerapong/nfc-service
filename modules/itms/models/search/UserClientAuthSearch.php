<?php

namespace app\modules\itms\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\itms\models\UserClientAuth;

/**
 * UserClientAuthSearch represents the model behind the search form of `app\modules\itms\models\UserClientAuth`.
 */
class UserClientAuthSearch extends UserClientAuth
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id'], 'integer'],
            [['user_login', 'user_login_pass', 'company_email', 'company_email_pass', 'mrp_user_login', 'mrp_user_login_pass', 'printer_code', 'phone_number', 'operator_name', 'operator_date', 'operator_comment', 'recorder_date', 'ref_code'], 'safe'],
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
        $query = UserClientAuth::find();

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
        ]);

        $query->andFilterWhere(['like', 'user_login', $this->user_login])
            ->andFilterWhere(['like', 'user_login_pass', $this->user_login_pass])
            ->andFilterWhere(['like', 'company_email', $this->company_email])
            ->andFilterWhere(['like', 'company_email_pass', $this->company_email_pass])
            ->andFilterWhere(['like', 'mrp_user_login', $this->mrp_user_login])
            ->andFilterWhere(['like', 'mrp_user_login_pass', $this->mrp_user_login_pass])
            ->andFilterWhere(['like', 'printer_code', $this->printer_code])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'operator_name', $this->operator_name])
            ->andFilterWhere(['like', 'operator_date', $this->operator_date])
            ->andFilterWhere(['like', 'operator_comment', $this->operator_comment])
            ->andFilterWhere(['like', 'recorder_date', $this->recorder_date])
            ->andFilterWhere(['like', 'ref_code', $this->ref_code]);

        return $dataProvider;
    }
}
