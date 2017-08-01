<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form about `common\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'operation_id', 'category_id', 'account_id_from', 'account_id_to',
                'value', 'currency_id', 'contragent_id', 'user_id', 'created_at'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transaction::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'operation_id' => $this->operation_id,
            'category_id' => $this->category_id,
            'account_id_from' => $this->account_id_from,
            'account_id_to' => $this->account_id_to,
            'value' => $this->value,
            'currency_id' => $this->currency_id,
            'contragent_id' => $this->contragent_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
