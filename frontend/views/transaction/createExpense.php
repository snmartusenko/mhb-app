<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\TransactionExpenseForm */

$this->title = 'Записать Расход';
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-expense-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_formExpense', [
        'model' => $model,
    ]) ?>

</div>
