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
     * @param $date
     * @return string
     */
    public static function getDate($date)
    {
        Yii::$app->formatter->timeZone = 'UTC';// эта запись устанавливает часовой пояс такой же как на сервере
        Yii::$app->formatter->locale = 'ru-RU';
        return Yii::$app->formatter->asDatetime($date, "php:l, d.m.Y");
//        return Yii::$app->formatter->asDate($date, 'l,  d.MM.Y');
    }
}