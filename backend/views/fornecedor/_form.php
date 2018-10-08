<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Fornecedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fornecedor-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'cpf_cnpj')->textInput(['maxlength' => 14]) ?>
        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
