<?php

use common\models\Operation;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
        $operations = Operation::find()
            ->where(['id' => 1])
            ->orWhere(['id' => 2])
            ->all();
        $operationItems = ArrayHelper::map($operations, 'id', 'name');
    ?>

    <?= $form->field($model, 'operation_id')->dropDownList($operationItems,
        [
            'prompt' => 'Выберите тип операции ...',
        ])
    ?>

    <?= $form->field($model, 'status')->dropDownList(
        [
            $model::STATUS_ACTIVE_VALUE => $model::STATUS_ACTIVE_LABEL,
            $model::STATUS_DELETED_VALUE => $model::STATUS_DELETED_LABEL,
        ],
        [
//            'prompt' => 'Выберите статус ...',
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
