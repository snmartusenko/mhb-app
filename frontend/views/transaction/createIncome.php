<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\TransactionIncomeForm */

$this->title = 'Записать Приход';
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-income-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_formIncome', [
        'model' => $model,
    ]) ?>

</div>
