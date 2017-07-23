<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\helpers\Helper;

/**
 * This is the model class for table "contragent".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $created_at
 *
 * @property Transaction[] $transactions
 */
class Contragent extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE_VALUE = 10;
//    const STATUS_INV = 5;
    const STATUS_DELETED_VALUE = 0;

    const STATUS_ACTIVE_LABEL = 'Активный';
    const STATUS_DELETED_LABEL = 'Удаленный';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contragent';
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
            'created_at' => 'Создан',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['contragent_id' => 'id']);
    }

    /**
     * @return null|string
     */
    public function getStatusLabel()
    {
        return Helper::getModelStatusLabel($this);
    }
}
