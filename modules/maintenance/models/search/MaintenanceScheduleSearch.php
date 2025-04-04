<?php

namespace app\modules\maintenance\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\maintenance\models\MaintenanceSchedule;

/**
 * MaintenanceScheduleSearch represents the model behind the search form of `app\modules\maintenance\models\MaintenanceSchedule`.
 */
class MaintenanceScheduleSearch extends MaintenanceSchedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['schedule_id', 'equipment_id', 'technician_id', 'type_id', 'frequency_id', 'status_id'], 'integer'],
            [['scheduled_date'], 'safe'],
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
        $query = MaintenanceSchedule::find();

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
            'schedule_id' => $this->schedule_id,
            'equipment_id' => $this->equipment_id,
            'technician_id' => $this->technician_id,
            'scheduled_date' => $this->scheduled_date,
            'type_id' => $this->type_id,
            'frequency_id' => $this->frequency_id,
            'status_id' => $this->status_id,
        ]);

        return $dataProvider;
    }
}
