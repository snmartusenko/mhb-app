<?php
/**
 * Created by PhpStorm.
 * User: Serg
 * Date: 20.07.2017
 * Time: 9:31
 */

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;

class TestController extends Controller
{
    public function actionIndex(){
        echo 'Hello';
    }
}