<?php

use common\models\Operation;
use common\models\Category;
use common\models\Account;
use common\models\Currency;
use common\models\Contragent;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $operations = Operation::find()->all();
    $operationItems = ArrayHelper::map($operations, 'id', 'name');

    $category = Category::find()->all();
    $categoryItems = ArrayHelper::map($category, 'id', 'name');

    $account = Account::find()->all();
    $accountItems = ArrayHelper::map($account, 'id', 'name');

    $currency = Currency::find()->all();
    $currencyItems = ArrayHelper::map($currency, 'id', 'name');

    $contragent = Contragent::find()->all();
    $contragentItems = ArrayHelper::map($contragent, 'id', 'name');

    $user = User::find()->all();
    $userItems = ArrayHelper::map($user, 'id', 'username');

    $sField = 'row .col-md-4';
    ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
//    <?= DateTimePicker::widget( [
        'name' => 'transaction-date',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => ['placeholder' => 'Ввод даты/времени...'],
        'convertFormat' => true,
//        'value' => function ($model) {
//            return ($model->date) ? date("d.m.Y h:i", (integer)$model->date) : date("d.m.Y h:i", (integer)time());
//        },
        'value' => date("d.m.Y", (integer)time()),

        'pluginOptions' => [
            'format' => 'dd.MM.yyyy hh:i',
            'autoclose' => true,
            'weekStart' => 1, //неделя начинается с понедельника
//    'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
            'todayBtn' => true, //снизу кнопка "сегодня"
            'todayHighlight' => true, //подсветка текущей даты
//            'initialDate' => date("d.m.Y h:i", time()),
//            'initialDate' => time(),
        ]
    ]); ?>

    <?= $form->field($model, 'operation_id')->dropDownList($operationItems,
        ['options' =>
            ['2' => ['selected ' => true]],
            ['prompt' => ''],
            ['class' => $sField],
        ]);
    ?>

    <?= $form->field($model, 'category_id')->dropDownList($categoryItems,
        ['prompt' => 'Выберите категорию ...',])
    ?>

    <?= $form->field($model, 'account_id')->dropDownList($accountItems,
        ['options' =>
            ['1' => ['selected ' => true]],
            ['prompt' => ''],
            ['class' => $sField],
        ]);
    ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currencyItems,
        ['options' =>
            ['1' => ['selected ' => true]],
            ['prompt' => ''],
        ]);
    ?>

    <?= $form->field($model, 'contragent_id')->dropDownList($contragentItems,
        ['prompt' => 'Выберите контрагента ...',])
    ?>

    <?= $form->field($model, 'user_id')->dropDownList($userItems,
        ['options' =>
            ['1' => ['selected ' => true]],
            ['prompt' => ''],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
