<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\helpers\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Транзакции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите это удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'date',
                'value' => function ($model) {
                    return Helper::getDate($model->date);
                }
            ],
            [
                'attribute' => 'operation_id',
                'value' => function ($model) {
                    return $model->operation->name;
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->name;
                }
            ],
            [
                'attribute' => 'account_id',
                'value' => function ($model) {
                    return $model->account->name;
                }
            ],
            'value',
            [
                'attribute' => 'currency_id',
                'value' => function ($model) {
                    return $model->currency->name;
                }
            ],
            [
                'attribute' => 'contragent_id',
                'value' => function ($model) {
                    return $model->contragent->name;
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => Helper::getDate($model->created_at)
            ],
        ],
    ]) ?>

</div>
