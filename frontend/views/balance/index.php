<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\helpers\Helper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\Balance */

$this->title = 'Баланс';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Обновить баланс', ['update'], ['class' => 'btn btn-success']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'account_id',
                'value' => function ($model) {
                    return $model->account->name;
                }
            ],
            'income',
            'expense',
            'current',
            'accounting_datetime:datetime',
            [
                'attribute' => 'accounting_datetime',
                'label' => 'Дата/время проводки',
                'format' => 'raw',
                'value' => function ($model) {
                    return Helper::getDateTime($model->accounting_datetime);
                },
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
