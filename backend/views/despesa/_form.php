<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\jui\AutoComplete;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $despesaModel backend\models\Despesa */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
    $(document).ready(function(){
        $('input').attr('autocomplete','off');
        $('#despesa-valor_unitario').on("keyup", function(){
            $('#despesa-valor_unitario').val($('#despesa-valor_unitario').val().replace(',', '.'));
            let valorTotal = $('#despesa-valor_unitario').val() * $('#despesa-qtde').val();
            $('#valor_total').val('R$' + valorTotal);
        });
        $('#despesa-qtde').on("keyup", function(){  
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
    <?= $form->errorSummary($despesaModel); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'tipo_desp')->dropdownList($despesaModel->getTiposDespesa(), ['value' => 2]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($itemModel, 'numero_item')->textInput([
                'onkeyup' => '
                    if(!$(this).val()){
                        $("#item_alert").hide();
                    }else{
                        $.get( "'.Url::toRoute(['/despesa/getiteminfo']).'", { numero : $(this).val(), tipo: $("#despesa-tipo_desp").val() })
                        .done(function(item) {
                            if(item.id !== null){
                                $("#item-descricao").val(item.descricao ? item.descricao : "N/A");
                                $("#despesa-id_item").val(item.id);
                                $("#item_alert").hide();
                            }else{
                                $("#item_alert").show();
                                $("#item-descricao").val("");
                                $("#despesa-id_item").val(null);
                            }
                        });
                    }'
            ])->label('Item') ?>
            <span class="item-alert" id="item_alert">Este item não existe.</span>
        </div>
        <div class="col-md-3">
            <?= $form->field($itemModel, 'descricao')->textInput([
                'readonly' => true
            ])->label('Descricão item') ?>
        </div>
        <div class="col-md-2">
            <label for="nome_fornecedor">Fornecedor</label>
            <?= AutoComplete::widget([
                'model' => $fornecedorModel,
                'attribute' => 'nome',
                'clientOptions' => [
                    'source' => $fornecedores,
                ],
                'options' => [
                    'class' => 'form-control',
                    'id' => 'nome_fornecedor',
                    'onchange' => '$.get( "'.Url::toRoute(['/despesa/getfornecedorinfo']).'", { nome : $(this).val() })
                                    .done(function(fornecedor) {
                                        if(fornecedor.id !== null){
                                            $("#fornecedor-cpf_cnpj").val(fornecedor.cpf_cnpj);
                                        }else{
                                            $("#despesa-id_fornecedor").val(null);
                                        }
                                });'
                ]
            ]); ?>

        </div>
        <div class="col-md-2">
            <?= $form->field($fornecedorModel, 'cpf_cnpj')->widget(MaskedInput::className(), [
            'mask' => ['999.999.999-99', '99.999.999/9999-99'],
        ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'numero_cheque')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
        <?= $form->field($despesaModel, 'data_pgto')->widget(MaskedInput::className(), [
            'clientOptions' => ['alias' =>  'date']
        ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'nf_recibo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'data_emissao_NF')->widget(MaskedInput::className(), [
            'clientOptions' => ['alias' =>  'date']
        ]) ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($despesaModel, 'valor_unitario')->textInput() ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($despesaModel, 'qtde')->textInput(['value' => 1]) ?>
        </div>
        <div class="col-md-1">
            <label for="valor_total">Valor total</label>
            <?= Html::textInput('valor_total', 'R$' + $despesaModel->valor_unitario * $despesaModel->qtde, [
                'class' => 'form-control', 
                'id' => 'valor_total',
                'readonly' => true,
                'autocomplete' => 'off'
            ]);?>
        </div>
        <div class="col-md-3">
            <?= $form->field($despesaModel, 'pendencias')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($beneficiarioModel, 'nome')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($beneficiarioModel, 'rg')->textInput()?>
        </div>
        <div class="col-md-2">
            <?= $form->field($beneficiarioModel, 'orgao_emissor')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($beneficiarioModel, 'nivel_academico')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'objetivo')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($despesaModel, 'status')->dropdownList($despesaModel->getStatus()) ?>
        </div>
    </div>

    
    <!-- destino -->
    <!-- data/hora ida -->
    <!-- data/hora volta -->
    <!-- localizador -->

    <div class="form-group">
        <?= Html::a('Voltar a lista', ['despesa/index'] ,['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>
    <?= $form->field($despesaModel, 'id_item')->hiddenInput()->label(false) ?>
    <?php ActiveForm::end(); ?>

</div>
