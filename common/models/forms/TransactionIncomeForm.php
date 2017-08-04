<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 02.08.2017
 * Time: 9:43
 */

namespace common\models\forms;

use common\models\Transaction;
use common\models\User;
use common\models\Account;
use common\models\Operation;
use common\models\Category;
use common\models\Contragent;
use common\models\Currency;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class TransactionIncomeForm
 * @package common\models\forms
 */
class TransactionIncomeForm extends Model
{
    public $operation_id = Operation::TYPE_INCOME_VALUE;

    public $id;
    public $date;
    public $category_id;
    public $account_id_to;
    public $value;
    public $currency_id;
    public $contragent_id;
    public $user_id;
    public $created_at;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'category_id', 'value', 'currency_id', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['id', 'category_id', 'account_id_to', 'value', 'currency_id', 'contragent_id', 'user_id', 'created_at'], 'integer'],

            [['date'], 'filter', 'filter' => function ($value) {
                if (!preg_match("/^[\d\+]+$/", $value) && $value > 0) {
                    return strtotime($value);
                } else {
                    return $value;
                }
            }],

            [['account_id_to'], 'required'],

            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['account_id_to'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id_to' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['contragent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contragent::className(), 'targetAttribute' => ['contragent_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
//            [['operation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operation::className(), 'targetAttribute' => ['operation_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'category_id' => 'Категория',
            'account_id_to' => 'Счет куда',
            'value' => 'Сумма',
            'currency_id' => 'Валюта',
            'contragent_id' => 'Контрагент',
            'user_id' => 'Пользователь',
            'created_at' => 'Создана',
        ];
    }

    /**
     * @return Transaction|null
     */
    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $model = new Transaction();
        $model->load([$model->formName() => ArrayHelper::toArray($this)]);

        if ($model->validate()) {
            if (!$this->hasErrors() && $model->save()) {
                return $model;
            }
        }

        $this->addErrors($model->getErrors());
        return null;
    }
}