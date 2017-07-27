<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\helpers\Helper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Транзакции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать транзакцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
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
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
