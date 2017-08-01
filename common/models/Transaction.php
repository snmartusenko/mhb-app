<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\helpers\Helper;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property string $date
 * @property integer $operation_id
 * @property integer $category_id
 * @property integer $account_id_from
 * @property integer $account_id_to
 * @property integer $value
 * @property integer $currency_id
 * @property integer $contragent_id
 * @property integer $user_id
 * @property integer $created_at
 *
 * @property User $user
 * @property Account $accountFrom
 * @property Account $accountTo
 * @property Category $category
 * @property Contragent $contragent
 * @property Currency $currency
 * @property Operation $operation
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            [['date', 'operation_id', 'category_id', 'value', 'currency_id', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['operation_id', 'category_id', 'account_id_from', 'account_id_to',
                'value', 'currency_id', 'contragent_id', 'user_id', 'created_at'], 'integer'],

            [['date'], 'filter', 'filter' => function ($value) {
                if (!preg_match("/^[\d\+]+$/", $value) && $value > 0) {
                    return strtotime($value);
                } else {
                    return $value;
                }
            }],
            [['account_id_to'], 'required',
                'when' => function ($model) {
                    return $model->operation_id == Operation::TYPE_INCOME_VALUE;
                },
                'enableClientValidation' => true,
                'whenClient' => "function (attribute, value) { return $('#transaction-operation_id').val() == 1;}",
            ],
            [['account_id_from'], 'required',
                'when' => function ($model) {
                    return $model->operation_id == Operation::TYPE_EXPENSE_VALUE;
                },
                'enableClientValidation' => true,
                'whenClient' => "function (attribute, value) { return $('#transaction-operation_id').val() == 2;}",
            ],
            [['account_id_from', 'account_id_to'], 'required',
                'when' => function ($model) {
                    return $model->operation_id == Operation::TYPE_TRANSFER_VALUE;
                },
                'enableClientValidation' => true,
                'whenClient' => "function (attribute, value) { return $('#transaction-operation_id').val() == 3;}",
            ],
            ['account_id_to', 'compare', 'compareAttribute' => 'account_id_from', 'operator' => '!='],


            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['account_id_from'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id_from' => 'id']],
            [['account_id_to'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id_to' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['contragent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contragent::className(), 'targetAttribute' => ['contragent_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['operation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Operation::className(), 'targetAttribute' => ['operation_id' => 'id']],
        ];
    }

//    public function beforeSave($insert)
//    {
//        if(parent::beforeSave($insert)){
//
//            $this->date = strtotime($this->date);
//        }
//
//        return true;
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'operation_id' => 'Операция',
            'category_id' => 'Категория',
            'account_id_from' => 'Счет откуда',
            'account_id_to' => 'Счет куда',
            'value' => 'Сумма',
            'currency_id' => 'Валюта',
            'contragent_id' => 'Контрагент',
            'user_id' => 'Пользователь',
            'created_at' => 'Создана',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFrom()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id_from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTo()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id_to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContragent()
    {
        return $this->hasOne(Contragent::className(), ['id' => 'contragent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperation()
    {
        return $this->hasOne(Operation::className(), ['id' => 'operation_id']);
    }
}
