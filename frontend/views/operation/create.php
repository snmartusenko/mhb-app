<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Operation */

$this->title = 'Создать операцию';
$this->params['breadcrumbs'][] = ['label' => 'Операции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
