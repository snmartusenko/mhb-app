<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 23.07.2017
 * Time: 13:16
 */

namespace common\models\helpers;

use Yii;

class Helper
{
    /**
     * for formatting of date
     * @param $value
     * @return string
     */
    public static function getDate($value)
    {
//        Yii::$app->formatter->timeZone = 'UTC';// эта запись устанавливает часовой пояс такой же как на сервере
        Yii::$app->formatter->locale = 'ru-RU';
        return Yii::$app->formatter->asDatetime($value, "php:d.m.Y");
//        return Yii::$app->formatter->asDate($date, 'l,  d.MM.Y');
    }

    /**
     * for formatting of time
     * @param $value
     * @return string
     */
    public static function getTime($value)
    {
        Yii::$app->formatter->locale = 'ru-RU';
        return Yii::$app->formatter->asDatetime($value, "php:H:i:s");
    }

    /**
     * for formatting of datetime
     * @param $value
     * @return string
     */
    public static function getDateTime($value)
    {
        Yii::$app->formatter->locale = 'ru-RU';
        return Yii::$app->formatter->asDatetime($value, "php:d.m.Y / H:i:s");
    }

    /**
     * @return null|string
     * @var $model
     */
    public static function getModelStatusLabel($model)
    {
        switch ($model->status) {
            case $model::STATUS_ACTIVE_VALUE:
                return $model::STATUS_ACTIVE_LABEL;
            case $model::STATUS_DELETED_VALUE:
                return $model::STATUS_DELETED_LABEL;
            default:
                return null;
        }
    }
}