<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\TransactionTransferForm */

$this->title = 'Записать Перемещение';
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-transfer-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_formTransfer', [
        'model' => $model,
    ]) ?>

</div>
