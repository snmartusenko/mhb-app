<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\helpers\Helper;

/**
 * This is the model class for table "operation".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $created_at
 *
 * @property Transaction[] $transactions
 */
class Operation extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE_VALUE = 10;
//    const STATUS_INV = 5;
    const STATUS_DELETED_VALUE = 0;

    const STATUS_ACTIVE_LABEL = 'Активная';
    const STATUS_DELETED_LABEL = 'Удаленная';

    const TYPE_INCOME_VALUE = 1;
    const TYPE_EXPENSE_VALUE = 2;
    const TYPE_TRANSFER_VALUE = 3;

    const TYPE_INCOME_LABEL = 'Приход';
    const TYPE_EXPENSE_LABEL = 'Расход';
    const TYPE_TRANSFER_LABEL = 'Перемещение';

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
    public static function tableName()
    {
        return 'operation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique', 'message' => 'Это имя уже используется'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE_VALUE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE_VALUE, self::STATUS_DELETED_VALUE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'status' => 'Статус',
            'created_at' => 'Создана',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['operation_id' => 'id']);
    }

    /**
     * @return null|string
     */
    public function getStatusLabel()
    {
        return Helper::getModelStatusLabel($this);
    }
}
