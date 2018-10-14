<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $despesaModel backend\models\Despesa */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
    $(document).ready(function(){
        $('#despesa-valor_unitario').on("keyup", function(){
            let valorTotal = $('#despesa-valor_unitario').val() * $('#despesa-qtde').val();
            $('#valor_total').val('R$' + valorTotal);
        });
        $('#despesa-qtde').on("keyup", function(){  
            //se a validação for por range, limpa e desativa os campos de prefixo
            let valorTotal = $('#despesa-valor_unitario').val() * $('#despesa-qtde').val();
            $('#valor_total').val('R$' + valorTotal);
        });
        $('#despesa-tipo_desp').on("change", function(){
            let tipo = $('#despesa-tipo_desp').val();
            if(tipo !== 2){
                alert('Ainda não é possível cadastrar este tipo de item!');
                $('#despesa-tipo_desp').val(2);
            }
        });
    });
JS;
$this->registerJs($script, View::POS_READY);
?>
<div class="despesa-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'tipo_desp')->dropdownList($despesaModel->getTiposDespesa(), ['value' => 2]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($despesaModel, 'id_item')->textInput()->label('Item') ?>
        </div>
        <div class="col-md-2">
            <label for="desc_item">Descrição item</label>
            <?= Html::textInput('desc_item', 'Exemplo desc item', [
                'class' => 'form-control', 
                'id' => 'desc_item',
                'readonly' => true,
                'autocomplete' => 'off'
            ]);?>
        </div>
        <div class="col-md-2">
            <?= $form->field($fornecedorModel, 'nome')->textInput()->label('Fornecedor') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($fornecedorModel, 'cpf_cnpj')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($despesaModel, 'numero_cheque')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?php echo '<label for="despesa-data_pgto">Data Pagamento</label>';
            echo DateTimePicker::widget([
                'model' => $despesaModel,
                'attribute' => 'data_pgto',
                'options' => ['placeholder' => 'Data de pagamento'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy hh:ii'
                ]
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'nf_recibo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?php echo '<label for="despesa-data_emissao_NF">Data emissão NF</label>';
            echo DateTimePicker::widget([
                'model' => $despesaModel,
                'attribute' => 'data_emissao_NF',
                'options' => ['placeholder' => 'Data de emissão de NF'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy'
                ]
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'valor_unitario')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'qtde')->textInput(['value' => 1]) ?>
        </div>
        <div class="col-md-2">
            <label for="valor_total">Valor total</label>
            <?= Html::textInput('valor_total', 'R$' + $despesaModel->valor_unitario * $despesaModel->qtde, [
                'class' => 'form-control', 
                'id' => 'valor_total',
                'readonly' => true,
                'autocomplete' => 'off'
            ]);?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($beneficiarioModel, 'nome')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($beneficiarioModel, 'rg')->textInput()?>
        </div>
        <div class="col-md-3">
            <?= $form->field($beneficiarioModel, 'orgao_emissor')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($beneficiarioModel, 'nivel_academico')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($despesaModel, 'objetivo')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($despesaModel, 'pendencias')->textInput() ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($despesaModel, 'status')->dropdownList($despesaModel->getStatus()) ?>
        </div>

    </div>

    
    <!-- destino -->
    <!-- data/hora ida -->
    <!-- data/hora volta -->
    <!-- localizador -->

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
