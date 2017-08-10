<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Balance */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Баланс', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'account_id',
            'income',
            'expense',
            'current',
            'accounting_datetime:datetime',
        ],
    ]) ?>

</div>
