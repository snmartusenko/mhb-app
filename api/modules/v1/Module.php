<?php
namespace api\modules\v1;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\v1\controllers';

    public function init()
    {
        parent::init();
        \Yii::configure(\Yii::$app, require(__DIR__ . '/config/main.php'));
        \Yii::$app->user->enableSession = false;
    }
}
