<?php

use common\models\Category;
use common\models\Account;
use common\models\Currency;
use common\models\Contragent;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-transfer-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}</div><div class="col-sm-10">{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
        ],

//        'layout'=>'horizontal',
//        'options' => ['class' => 'signup-form form-register1'],
//        'fieldConfig' => [
//            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
//            'horizontalCssClasses' => [
//                'label' => 'col-sm-4',
//                'offset' => 'col-sm-offset-4',
//                'wrapper' => 'col-sm-8',
//                'error' => '',
//                'hint' => '',
//            ],
//        ],
    ]); ?>

    <?php
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

    $model->date ? $model->date : $model->date = time();
    ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), [
        'name' => 'date',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'options' => [
            'value' => date("d.m.Y", $model->date),
        ],
        'convertFormat' => false, // php and yii formats
        'pluginOptions' => [
            'format' => 'dd.mm.yyyy',
            'autoclose' => true,
            'weekStart' => 1, //неделя начинается с понедельника
            'todayBtn' => true, //снизу кнопка "сегодня"
            'todayHighlight' => true, //подсветка текущей даты
//            'initialDate' => date("d.m.Y", (integer)time()), //do not work in $form->field
        ]
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categoryItems,
        ['prompt' => 'Выберите категорию ...',])
    ?>

    <?= $form->field($model, 'account_id_from')->dropDownList($accountItems,
        [
            'prompt' => 'Выберите Счет откуда ...',
            'options' => [
//                '1' => ['selected ' => true],
            ],
        ]);
    ?>

    <?= $form->field($model, 'account_id_to')->dropDownList($accountItems,
        [
            'prompt' => 'Выберите Счет куда ...',
            'options' => [
//                '2' => ['selected ' => true],
            ],
        ]);
    ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'currency_id')->dropDownList($currencyItems,
        [
            'prompt' => 'Выберите валюту ...',
            'options' => [
                '1' => ['selected ' => true],
            ],
        ]
    );
    ?>

    <?= $form->field($model, 'contragent_id')->dropDownList($contragentItems,
        ['prompt' => 'Выберите контрагента ...',])
    ?>

    <?= $form->field($model, 'user_id')->dropDownList($userItems,
        [
            'prompt' => 'Выберите пользователя ...',
            'options' => [
                '1' => ['selected ' => true],
            ],
        ]);
    ?>

    <div class="form-group" class="col-lg-offset-6 col-lg-11">
<!--        --><?//= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
