<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "balance".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $income
 * @property integer $expense
 * @property integer $current
 * @property integer $accounting_datetime
 *
 * @property Account $account
 * @property Transaction[] $incomeTransactions
 * @property Transaction[] $expenseTransactions
 */
class Balance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balance';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['accounting_datetime'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'income', 'expense', 'current', 'accounting_datetime'], 'integer'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Счет',
            'income' => 'Приход',
            'expense' => 'Расход',
            'current' => 'Остаток',
            'accounting_datetime' => 'Время проводки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomeTransactions()
    {
        return $this->hasMany(Transaction::className(), ['account_id_to' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseTransactions()
    {
        return $this->hasMany(Transaction::className(), ['account_id_from' => 'account_id']);
    }

    /**
     * @return bool|null
     */
    public static function updateAllBalance()
    {
        $models = self::find()->all();
        if ($models) {
            foreach ($models as $model) {
                /** @var self $model */
                if (!$model->updateBalance()){
                    return false;
                }
            }
            return true;
        }
        return null;
    }

    public function updateBalance()
    {
        $income = $this->countIncome();
        $expense = $this->countExpense();
        $current = $income - $expense;

        if ($this->load([
                $this->formName() =>
                    [
                        'income' => $income,
                        'expense' => $expense,
                        'current' => $current,
                    ]
            ]) && $this->save()
        ) {
            return $this;
        } else {
            return false;
        }
    }

    /**
     * @return int|null
     */
    public function countIncome()
    {
        $transactions = $this->incomeTransactions;

        if ($transactions) {
            $value = 0;
            foreach ($transactions as $transaction) {
                $value += $transaction->value;
            }
            return $value;
        }
        return null;
    }

    /**
     * @return int|null
     */
    public function countExpense()
    {
        $transactions = $this->expenseTransactions;

        if ($transactions) {
            $value = 0;
            foreach ($transactions as $transaction) {
                $value += $transaction->value;
            }
            return $value;
        }
        return null;
    }
}
