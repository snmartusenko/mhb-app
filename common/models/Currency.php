<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $created_at
 *
 * @property Transaction[] $transactions
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at'], 'required'],
            [['status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['currency_id' => 'id']);
    }
}
