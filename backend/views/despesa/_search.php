<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DespesaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despesa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'valor_unitario') ?>

    <?= $form->field($model, 'qtde') ?>

    <?= $form->field($model, 'tipo_desp') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'data_emissao_NF') ?>

    <?php // echo $form->field($model, 'pendencias') ?>

    <?php // echo $form->field($model, 'numero_cheque') ?>

    <?php // echo $form->field($model, 'data_pgto') ?>

    <?php // echo $form->field($model, 'nf_recibo') ?>

    <?php // echo $form->field($model, 'objetivo') ?>

    <?php // echo $form->field($model, 'id_beneficiario') ?>

    <?php // echo $form->field($model, 'id_fornecedor') ?>

    <?php // echo $form->field($model, 'id_item') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
